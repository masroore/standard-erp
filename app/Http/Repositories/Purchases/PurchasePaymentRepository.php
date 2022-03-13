<?php
namespace App\Http\Repositories\Purchases;
use App\Http\Interfaces\Purchases\PurchasePaymentInterface;
use App\Models\Finance\FinBank;
use App\Models\Finance\FinCheck;
use App\Models\Finance\FinJournal;
use App\Models\Finance\FinJournalDetail;
use App\Models\Finance\FinSetting;
use App\Models\Finance\FinTransaction;
use App\Models\Purchase\BuyPurchaseInvoice;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PurchasePaymentRepository  implements PurchasePaymentInterface
{
    private $model;

    public function __construct(FinTransaction $model)
    {
        $this->model = $model;
    }// end of construct

    public function index($request){
       // dd($request->all());

        $purchId     = $request->purch_id;
        $banks       = FinBank::select('id','title_en','account_id')->get();
        $rows        = $this->model::select('id','created_at','code','amount','paying_method')
                                    ->where('purch_id', $purchId)
                                    ->orderBy('id','desc')
                                    ->get();
        $invoiceData = BuyPurchaseInvoice::select('id','is_paid','remaining_amount','supplier_id','reference_no','paid_amount')
                       ->where('id',$purchId)->first();
        return view('backend.purchases.payments.index', compact('rows','banks','invoiceData'));




    }//end of index

    public function data()
    {
       // $roles = Role::whereNotIn('name', ['super_admin', 'admin', 'user']) ->withCount(['users']);

            $rows        = $this->model::select('id','created_at','code','amount','paying_method')

            ->orderBy('id','desc')
            ->get(); //DataTables
        return DataTables::of($rows)

            ->addColumn('actions')
            ->rawColumns(['actions'])
            ->toJson();
    }// end of data

    public function store($request){

        $request->validate([
            'code'     => 'required',
            'amount'   => 'required',
        ]);

        if($request->paying_method == 'check'){
            $receiveDate    = $request->created_date;
            $dueDate        = $request->due_date;
            $documentCode   = $request->document_code;
            $transfare_fees = 0;
        }elseif($request->paying_method == 'transfare'){
            $receiveDate    = '';
            $dueDate        = $request->due_date;
            $documentCode   = $request->document_code;
            $transfare_fees = $request->bank_transfare_fees;

            //dd($transfare_fees);
        }else{
            $receiveDate    = '';
            $dueDate        = '';
            $documentCode   = '';
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

        //update purchase invoice
        $paidAmount      = $request->amount + $request->paid_amount;
        $remainingAmount = $request->remaining_amount;
        $isPaid          = (0 == $remainingAmount) ? 1 : 0 ;

        $updatePurchase  = BuyPurchaseInvoice::where('id',$request->purch_id)->update([
            'remaining_amount' => $remainingAmount,
            'paid_amount'      => $paidAmount,
            'is_paid'          => $isPaid,
        ]);

        $supplierAccount = Supplier::where('id',$request->supplier_id)->select('account_id','id','opening_balance')->first();
        // handel supllier balanace
            $newBlanace     = $supplierAccount->opening_balance - $request->amount; ;
            $updateSupplieralance = Supplier::where('id',$request->supplier_id)->update([
                'opening_balance' => $newBlanace
            ]);

        // handel jounral entries
        $details = "سداد دفعة للمورد";
        $jornal =   $this->handelJournal($request,$details);

        $direct         = 'direct';
        $setting        = 'setting';

        $accountKey     = $supplierAccount->account_id;
        $SupplierAmount = $request->amount;
        $this->handelJournalDetailsDebit($accountKey,$jornal,$SupplierAmount,$direct);

        if($request->paying_method == 'check'){
            //create check
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

        if( config('app.locale') == 'ar'){ alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Created Successfully', 'Good Work'); }
        return redirect()->back();

    }// end of store

    public function show($id){
        $paymentRow = $this->model::where('id', $id)->first();
        //dd($paymentRow);
        return view('backend.purchases.payments.show', compact('paymentRow'));
    }
    public function update($request,$id){

        $row =   $this->model::FindOrFail($id);
        $request->validate([
            'code'    => 'required',
            'start_at'=> 'required',
        ]);

        $requestArray =  $request->all();
        $row->update($requestArray);

        if( config('app.locale') == 'ar'){ alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Created Successfully', 'Good Work'); }
        return redirect()->route('dashboard.purchases-payments.index');
    }// end of update

    public function destroy($id){

       $row = $this->model::FindOrFail($id);

      // dd($row);

       $invoiceData = BuyPurchaseInvoice::select('supplier_id','id','is_paid','remaining_amount','reference_no','paid_amount')
       ->where('id',$row->purch_id)->first();

       $paidAmount      = $invoiceData->paid_amount - $row->amount;
       $remainingAmount = $invoiceData->remaining_amount + $row->amount;
       $isPaid           = (0 == $remainingAmount) ? 1 : 0 ;

        $updatePurchase  = BuyPurchaseInvoice::where('id',$row->purch_id)->update([
            'remaining_amount' => $remainingAmount,
            'paid_amount'      => $paidAmount,
            'is_paid'          => $isPaid,
        ]);

        $supplierAccount = Supplier::where('id',$invoiceData->supplier_id)->select('account_id')->first();
        $datenow = Carbon::now();
        $details = "تعديل وحذف  دفعة للمورد";
        $jornal =   $this->handelJournal($datenow,$details);

        $accountKey     = $supplierAccount->account_id;
        $debitKeyType   = 'direct';
        $SupplierAmount = $row->amount;
        $this->handelJournalDetailsDebit($accountKey,$jornal,$SupplierAmount,$debitKeyType);

        $cashKey   = 'Cash';
        $cridetKeyType  = 'setting';
        $casAmount = $row->amount;
        $this->handelJournalDetailsCridet($cashKey,$jornal,$casAmount, $cridetKeyType);

        $this->model::FindOrFail($id)->delete();

        if( config('app.locale') == 'ar'){
            alert()->success('تم حذف بيانات السجل بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Deleted Successfully', 'Good Work');
        }
        return redirect()->back();

    }// end of destroy

    protected function handelJournal($request,$details){

        $jornal =  FinJournal::create([
            'user_id'   => Auth::user()->id,
            'ref'       => date("shdmy"),
            'date'      => Carbon::now(),
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

} // end of class

?>

