<?php
namespace App\Http\Repositories\Finance;

use App\Http\Interfaces\Finance\FinTransactionInterface;
use App\Models\Customer;
use App\Models\Finance\FinBank;
use App\Models\Finance\FinCheck;
use App\Models\Finance\FinJournal;
use App\Models\Finance\FinJournalDetail;
use App\Models\Finance\FinSetting;
use App\Models\Finance\FinTransaction;
use App\Models\Purchase\BuyPurchaseInvoice;
use App\Models\Sales\SalInvoice;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FinTransactionRepository  implements FinTransactionInterface
{

    private $model;

    public function __construct(FinTransaction $model)
    {
        $this->model = $model;
    }// end of construct

    public function paymentToSupplier()
    {
        $banks     = FinBank::all('id','title_en');
        $suppliers = Supplier::all('id','contact_person','company_name');
        $rows      = $this->model::where('belong', 'supplier')->with('supplier:id,contact_person,company_name')->get();
       // dd($rows);
        return view('backend.finance.transactions.supplier.index',compact('rows','banks','suppliers'));
    }//end of paymentToSupplier

    public function saveSupplierPayment($request){
       // dd($request->all());

       //save new transaction

        if($request->paying_method == 'check'){
            $receiveDate    = $request->created_date;
            $dueDate        = $request->due_date;
            $documentCode   = $request->document_code;
            $transfare_fees = 0;
        }elseif($request->paying_method == 'transfare'){
            $receiveDate    = null;
            $dueDate        = $request->due_date;
            $documentCode   = $request->document_code;
            $transfare_fees = $request->bank_transfare_fees;

            //dd($transfare_fees);
        }else{
            $receiveDate    = null;
            $dueDate        = null;
            $documentCode   = null;
            $transfare_fees = 0;
        }

        $requestArray = [
            'belong'             => 'supplier',
            'type'               => 'debit',
            'check_receive_date' => $receiveDate,
            'due_date'           => $dueDate ,
            'document_code'      => $documentCode,
            'created_by'         => Auth::id(),
            'bank_transfare_fees'=> $transfare_fees,

        ] + $request->all();

        $row =  $this->model->create($requestArray);
        //update supplier balance
        $supplier = Supplier::select('id','company_name','account_id','opening_balance')
                                ->where('id',$request->supplier_id)
                                ->first();
        $newbalance = $supplier->opening_balance - $request->amount ;

        $updateSupplierBalance = Supplier::where('id',$supplier->id)->update([
            'opening_balance' => $newbalance
        ]);


        // handel jouranlis entries

        $details = "سداد دفعة للمورد";
        $jornal =   $this->handelJournal($request,$details);

        $direct         = 'direct';
        $setting        = 'setting';

        $accountKey     = $supplier->account_id;
        $SupplierAmount = $request->amount;
        $this->handelJournalDetailsDebit($accountKey,$jornal,$SupplierAmount,$direct);

        if($request->paying_method == 'check'){

            //create new check
            $transaction = $row->id;
            $blong       = 'supplier';
            $beneficiary = $request->supplier_id;
            $type        = 'payable';
            $this->createCheck($transaction,$request ,$blong ,$beneficiary,$type);

            $cashKey        = 'PayPaper';
            $casAmount      = $request->amount;
            $this->handelJournalDetailsCridet($cashKey,$jornal,$casAmount, $setting);

        }
        elseif($request->paying_method == 'transfare'){

            $bankExpenseKey = 'BankExpenses';
            $banExpenseAmount = $request->bank_transfare_fees;
            $this->handelJournalDetailsDebit($bankExpenseKey,$jornal,$banExpenseAmount,$setting);

            $bankInfo = FinBank::select('id','account_id')->where('id',$request->bank_id)->first();
            $cashKey        = $bankInfo->account_id;
            $casAmount      = $request->amount + $banExpenseAmount;
            $this->handelJournalDetailsCridet($cashKey,$jornal,$casAmount, $direct);

        }
        else{
            $cashKey        = 'Cash';
            $casAmount      = $request->amount;
            $this->handelJournalDetailsCridet($cashKey,$jornal,$casAmount, $setting);

        }


        // handel purchase invoice

        $purchases = BuyPurchaseInvoice::select('supplier_id','remaining_amount','is_paid','id','created_at')
                                        ->where([['supplier_id',$request->supplier_id],['is_paid',0]])
                                        ->orderBy('created_at','asc')
                                        ->get();

        // dd($purchases);
        $totalAmount = $request->amount;

        foreach($purchases as $purch){
            if($totalAmount > 0){
                if( $totalAmount >  $purch->remaining_amount ){

                    $newTotalAmount =  $totalAmount - $purch->remaining_amount ;
                    $updatePurchase = BuyPurchaseInvoice::where('id',$purch->id)
                        ->update([
                            'remaining_amount' => 0 ,
                            'is_paid' => 1,
                        ]);
                        $totalAmount = $newTotalAmount;

                }elseif($totalAmount < $purch->remaining_amount){
                    $newTotalAmount = $purch->remaining_amount - $totalAmount ;
                    $updatePurchase = BuyPurchaseInvoice::where('id',$purch->id)
                        ->update([
                            'remaining_amount' => $newTotalAmount ,
                            'is_paid' => 0,
                        ]);
                        $totalAmount = 0;

                }elseif($totalAmount == $purch->remaining_amount){
                    $updatePurchase = BuyPurchaseInvoice::where('id',$purch->id)
                        ->update([
                            'remaining_amount' => 0 ,
                            'is_paid' => 1,
                        ]);

                        $totalAmount = 0;
                } //end of elseif

            }// end o fif


        }



        if( config('app.locale') == 'ar'){ alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Created Successfully', 'Good Work'); }
        return redirect()->back();


    }// end of saveSupplierPayment


    protected function updateSuppllierBalance($request){
        $supplierAmount = $request->remaining_amount;
        $supplierInfo   = Supplier::select('id','opening_balance')
        ->where('id',$request->supplier_id)->first();
        $newBlanace     = $supplierInfo->opening_balance + $supplierAmount ;
        $updateSupplieralance = Supplier::where('id',$request->supplier_id)->update([
            'opening_balance' => $newBlanace
        ]);
        return 1;
    }//end of update Suppllier Balance



    public function customerPayment()
    {
        $banks     = FinBank::all('id','title_en');
        $customers = Customer::all('id','name','company_name');
        $rows      = $this->model::where('belong', 'customer')->with('customer:id,name,company_name')->get();
       // dd($rows);
        return view('backend.finance.transactions.customer.index',compact('rows','banks','customers'));
    }//end of paymentToSupplier

    public function saveCustomerPayment($request){
       // dd($request->all());

       //save new transaction

        if($request->paying_method == 'check'){
            $receiveDate    = $request->created_date;
            $dueDate        = $request->due_date;
            $documentCode   = $request->document_code;
            $transfare_fees = 0;
        }elseif($request->paying_method == 'transfare'){
            $receiveDate    = null;
            $dueDate        = $request->due_date;
            $documentCode   = $request->document_code;
            $transfare_fees = $request->bank_transfare_fees;

            //dd($transfare_fees);
        }else{
            $receiveDate    = null;
            $dueDate        = null;
            $documentCode   = null;
            $transfare_fees = 0;
        }

        $requestArray = [
            'belong'             => 'customer',
            'type'               => 'debit',
            'check_receive_date' => $receiveDate,
            'due_date'           => $dueDate ,
            'document_code'      => $documentCode,
            'created_by'         => Auth::id(),
            'bank_transfare_fees'=> $transfare_fees,

        ] + $request->all();

        $row =  $this->model->create($requestArray);
        //update customer balance
        $customer = Customer::select('id','company_name','account_id','opening_balance')
                                ->where('id',$request->customer_id)
                                ->first();
        $newbalance = $customer->opening_balance - $request->amount ;

        $updateCustomerBalance = Customer::where('id',$customer->id)->update([
            'opening_balance' => $newbalance
        ]);


        // handel jouranlis entries

        $details = "تحصيل من عميل ";
        $jornal =   $this->handelJournal($request,$details);

        $direct         = 'direct';
        $setting        = 'setting';


        if($request->paying_method == 'check'){
             //create new check
             $transaction = $row->id;
             $blong       = 'customer';
             $beneficiary = $request->customer_id;
             $type        = 'receivable';
             $this->createCheck($transaction,$request ,$blong ,$beneficiary,$type);

            $cashKey        = 'NotesReceivables';
            $casAmount      = $request->amount;
            $this->handelJournalDetailsDebit($cashKey,$jornal,$casAmount, $setting);

        }
        elseif($request->paying_method == 'transfare'){

            // $bankExpenseKey = 'BankExpenses';
            // $banExpenseAmount = $request->bank_transfare_fees;
            // $this->handelJournalDetailsDebit($bankExpenseKey,$jornal,$banExpenseAmount,$setting);

            $bankInfo       = FinBank::select('id','account_id')->where('id',$request->bank_id)->first();
            $cashKey        = $bankInfo->account_id;
            $casAmount      = $request->amount ;
            $this->handelJournalDetailsDebit($cashKey,$jornal,$casAmount, $direct);

        }
        else{
            $cashKey        = 'Cash';
            $casAmount      = $request->amount;
            $this->handelJournalDetailsDebit($cashKey,$jornal,$casAmount, $setting);

        }

        $accountKey     = $customer->account_id;
        $customerAmount = $request->amount;
        $this->handelJournalDetailsCridet($accountKey,$jornal,$customerAmount,$direct);



        // handel sales invoice

        $salesInvoices = SalInvoice::select('customer_id','remaining_amount','is_paid','id','created_at')
                                        ->where([['customer_id',$request->customer_id],['is_paid',0]])
                                        ->orderBy('created_at','asc')
                                        ->get();

        //        dd($salesInvoices);
        $totalAmount = $request->amount;

        foreach($salesInvoices as $invoice){
            if($totalAmount > 0){
                if( $totalAmount >  $invoice->remaining_amount ){

                    $newTotalAmount =  $totalAmount - $invoice->remaining_amount ;
                    $updateInvoice = SalInvoice::where('id',$invoice->id)
                        ->update([
                            'remaining_amount' => 0 ,
                            'is_paid' => 1,
                        ]);
                        $totalAmount = $newTotalAmount;

                }elseif($totalAmount < $invoice->remaining_amount){
                    $newTotalAmount = $invoice->remaining_amount - $totalAmount ;
                    $updateInvoice = SalInvoice::where('id',$invoice->id)
                        ->update([
                            'remaining_amount' => $newTotalAmount ,
                            'is_paid' => 0,
                        ]);
                        $totalAmount = 0;

                }elseif($totalAmount == $invoice->remaining_amount){
                    $updateInvoice = SalInvoice::where('id',$invoice->id)
                        ->update([
                            'remaining_amount' => 0 ,
                            'is_paid' => 1,
                        ]);

                        $totalAmount = 0;
                } //end of elseif

            }// end o fif


        }



        if( config('app.locale') == 'ar'){ alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Created Successfully', 'Good Work'); }
        return redirect()->back();


    }// end of saveSupplierPayment

    public function getAllChecks(){
        $banks             = FinBank::all('id','title_en');
        $customers         = Customer::all('id','name','company_name');
        $suppliers         = Supplier::all('id','contact_person','company_name');
        $checksRecivable   = $this->model::where([['paying_method', 'check'],['belong','supplier']])
        ->with('customer:id,name,company_name')->get();
        $checksPayable     = $this->model::where([['paying_method', 'check'],['belong','supplier']])
        ->with('supplier:id,contact_person,company_name')->get();
        $rows = FinCheck::all();
        return view('backend.finance.transactions.checks.index',compact('rows','banks','customers','suppliers'));
    }//end of checks

    public function changeChekStatus($request){

        //get check Info
        $updateChek      =  FinCheck::FindOrFail($request->transaction_id);

        //handel journal
        $details         = 'تسوية الشيك';
        $amount          = $updateChek->amount;
        $direct          = 'direct';
        $setting         = 'setting';
        $bankAccount     = FinBank::select('id','account_id')->where('id',$updateChek->bank_id )->first();
        $jornal          =   $this->handelJournal($request,$details);
        //if check paid


        if($request->check_status == 1){

            if($updateChek->belong_to == 'supplier'){
                //handel debit value
                $accountKey = 'PayPaper';
                $this->handelJournalDetailsDebit($accountKey,$jornal,$amount,$setting);
                //handel credit
                $accountKey =  $bankAccount->account_id;
                $this->handelJournalDetailsCridet($accountKey,$jornal,$amount,$direct);

            }elseif($updateChek->belong_to == 'customer'){
                //handel debit value
                $accountKey = 'NotesReceivables';
                $this->handelJournalDetailsDebit($accountKey,$jornal,$amount,$setting);
                //handel credit
                $accountKey =  $bankAccount->account_id;
                $this->handelJournalDetailsCridet($accountKey,$jornal,$amount,$direct);

            }

        //if check bounced
        }elseif($request->check_status == 2){

            if($updateChek->belong_to == 'supplier'){
                $supplierAccount = Supplier::select('id','account_id','opening_balance')->where('id',$updateChek->beneficiary)->first();
                //handel debit value
                $accountKey = 'PayPaper';
                $this->handelJournalDetailsDebit($accountKey,$jornal,$amount,$setting);
                //handel credit
                $accountKey = $supplierAccount->account_id;
                $this->handelJournalDetailsCridet($accountKey,$jornal,$amount,$direct);

                //update supplier balance

                $newBlanace     = $supplierAccount->opening_balance + $amount ;
                $updateSupplieralance = Supplier::where('id',$updateChek->beneficiary)->update([
                    'opening_balance' => $newBlanace
                ]);

            }elseif($updateChek->belong_to == 'customer'){
                $customerAccount = Customer::select('id','account_id','opening_balance')->where('id',$updateChek->beneficiary)->first();
                $accountKey = 'NotesReceivables';
                $this->handelJournalDetailsDebit($accountKey,$jornal,$amount,$setting);
                //handel credit
                $accountKey = $customerAccount->account_id;
                $this->handelJournalDetailsCridet($accountKey,$jornal,$amount,$direct);

                //update customer balance

                $newBlanace     = $customerAccount->opening_balance + $amount ;
                $updateCustomerbalance = Customer::where('id',$updateChek->beneficiary)->update([
                    'opening_balance' => $newBlanace
                ]);
            }
        }

        //update check status
        $updateChek  =  $updateChek->update([
            'status' => $request->check_status
        ]);

        return redirect()->back();
    }// end of changeChekStatus

    protected function handelJournal($request,$details){

        $jornal =  FinJournal::create([
            'user_id'   => Auth::user()->id,
            'ref'       => date("shdmy"),
            'date'      => $request->created_at , //Carbon::now(),
            'details'   => $details,
            'attachment'=> '',

        ]);

        $jornal =  $jornal->id;
        return $jornal ;

    }// end of handelJournal

    protected function handelJournalDetailsCridet($accountKey,$jornal,$amount,$type){

        if($type == 'direct'){
            $accountId    = $accountKey;
        }elseif($type == 'setting'){
            $account      =  FinSetting::where('account_key' , '=' , $accountKey)->first();
            $accountId    = $account->account_id;
        }


        FinJournalDetail::create([
            'journal_id'=> $jornal,
            'account_id'=> $accountId,
            'credit'    => $amount,
            'debit'     => 0,
        ]);

        return 1;
    } //end of handelJournalDetails Cridet

    protected function handelJournalDetailsDebit($accountKey,$jornal,$amount,$type){

        if($type == 'direct'){
            $accountId    = $accountKey;
        }elseif($type == 'setting'){
            $account      =  FinSetting::where('account_key' , '=' , $accountKey)->first();
            $accountId    = $account->account_id;
        }


        FinJournalDetail::create([
            'journal_id'=> $jornal,
            'account_id'=> $accountId,
            'credit'    => 0,
            'debit'     => $amount,
        ]);

        return 1;

    } //end of handelJournalDetails Debit

    protected function createCheck($transaction,$request ,$blong ,$beneficiary,$type){

        FinCheck::create([
            'transaction_id'  => $transaction ,
            'bank_id'         => $request->bank_id,
            'belong_to'       => $blong ,
            'beneficiary'     => $beneficiary ,
            'release_date'    => $request->created_date ,
            'due_date'        => $request->due_date,
            'check_number'    => $request->document_code ,
            'amount'          => $request->amount ,
            'type'            => $type,
            'status'          => 0,
            'notes'           => $request->notes
        ]);
    }// end of create check



}// end of class

?>
