<?php
namespace App\Http\Repositories\Sales;
use App\Http\Interfaces\Sales\SalPaymentInterface;
use App\Models\Customer;
use App\Models\Finance\FinBank;
use App\Models\Finance\FinCheck;
use App\Models\Finance\FinJournal;
use App\Models\Finance\FinJournalDetail;
use App\Models\Finance\FinSetting;
use App\Models\Finance\FinTransaction;
use App\Models\Sales\SalInvoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class SalPaymentRepository  implements SalPaymentInterface
{
    private $model;

    public function __construct(FinTransaction $model)
    {
        $this->model = $model;
    }// end of construct

    public function index($request){
       // dd($request->all());

        $salId       = $request->sal_id;
        $banks       = FinBank::select('id','title_en','account_id')->get();
        $rows        = $this->model::select('id','created_at','code','amount','paying_method')
                                    ->where('sale_id', $salId)
                                    ->orderBy('id','desc')
                                    ->get();
        $invoiceData = SalInvoice::select('id','is_paid','remaining_amount','customer_id','reference_no','paid_amount')
                       ->where('id',$salId)->first();
        return view('backend.sales.payments.index', compact('rows','banks','invoiceData'));

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
            'belong'             => 'customer',
            'type'               => 'debit',
            'check_receive_date' => $receiveDate,
            'due_date'           => $dueDate ,
            'document_code'      => $documentCode,
            'created_by'         => Auth::id(),
            'bank_transfare_fees'=> $transfare_fees,

        ] + $request->all();
        $row =  $this->model->create($requestArray);

        //update sale invoice
        $paidAmount      = $request->amount + $request->paid_amount;
        $remainingAmount = $request->remaining_amount;
        $isPaid          = (0 == $remainingAmount) ? 1 : 0 ;

        $updateSale      = SalInvoice::where('id',$request->sal_id)->update([
            'remaining_amount' => $remainingAmount,
            'paid_amount'      => $paidAmount,
            'is_paid'          => $isPaid,
        ]);

        $customerAccount = Customer::where('id',$request->customer_id)->select('account_id','id','opening_balance')->first();
        // handel supllier balanace
            $newBlanace            = $customerAccount->opening_balance - $request->amount; ;
            $updateCustomerBalance = Customer::where('id',$request->customer_id)->update([
                'opening_balance' => $newBlanace
            ]);

        // handel jounral entries
        $details = "تحصيل دفعة من عميل ";
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

            $bankInfo = FinBank::select('id','account_id')->where('id',$request->bank_id)->first();
            $cashKey        = $bankInfo->account_id;
            $casAmount      = $request->amount ;
            $this->handelJournalDetailsDebit($cashKey,$jornal,$casAmount, $direct);

        }
        else{
            $cashKey        = 'Cash';
            $casAmount      = $request->amount;
            $this->handelJournalDetailsDebit($cashKey,$jornal,$casAmount, $setting);

        }

        $accountKey     = $customerAccount->account_id;
        $customerAmount = $request->amount;
        $this->handelJournalDetailsCridet($accountKey,$jornal,$customerAmount,$direct);

        if( config('app.locale') == 'ar'){ alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Created Successfully', 'Good Work'); }
        return redirect()->back();

    }// end of store

    public function show($id){
        $paymentRow = $this->model::where('id', $id)->first();
       // dd($paymentRow);
        return view('backend.sales.payments.show', compact('paymentRow'));
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

       $invoiceData = SalInvoice::select('customer_id','id','is_paid','remaining_amount','reference_no','paid_amount')
       ->where('id',$row->sal_id)->first();

       $paidAmount      = $invoiceData->paid_amount - $row->amount;
       $remainingAmount = $invoiceData->remaining_amount + $row->amount;
       $isPaid           = (0 == $remainingAmount) ? 1 : 0 ;

        $updateSale  = SalInvoice::where('id',$row->sale_id)->update([
            'remaining_amount' => $remainingAmount,
            'paid_amount'      => $paidAmount,
            'is_paid'          => $isPaid,
        ]);

        $customerAccount = Customer::where('id',$invoiceData->customer_id)->select('account_id')->first();
        $datenow = Carbon::now();
        $details = "تعديل وحذف  دفعة عميل";
        $jornal =   $this->handelJournal($datenow,$details);

        $direct   = 'direct';
        $setting  = 'setting';

        $accountKey     = $customerAccount->account_id;
        $customerAmount = $row->amount;
        $this->handelJournalDetailsDebit($accountKey,$jornal,$customerAmount,$direct);

        $cashKey   = 'Cash';

        $casAmount = $row->amount;
        $this->handelJournalDetailsCridet($cashKey,$jornal,$casAmount, $setting);

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

