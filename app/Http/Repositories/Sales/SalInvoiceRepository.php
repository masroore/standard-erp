<?php
namespace App\Http\Repositories\Sales;
use App\Models\Finance\FinAccount;
use App\Http\Interfaces\Sales\SalInvoiceInterface;
use App\Models\Customer;
use App\Models\Finance\FinBank;
use App\Models\Finance\FinCheck;
use App\Models\Finance\FinJournal;
use App\Models\Finance\FinJournalDetail;
use App\Models\Finance\FinSetting;
use App\Models\Finance\FinTransaction;
use App\Models\Sales\SalDeliver;
use App\Models\Sales\SalDeliverDetail;
use App\Models\Sales\SalInvoice;
use App\Models\Sales\SalInvoiceDetail;
use App\Models\Store\StoItem;
use App\Models\Store\StoItemCard;
use App\Models\Store\StoQuantity;
use App\Models\Store\StoStore;
use App\Models\Store\StoUnit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class SalInvoiceRepository  implements SalInvoiceInterface
{

    private $model;

    public function __construct(SalInvoice $model)
    {
        $this->model = $model;
    }

    public function index(){
        $routeName = 'sales';
        $rows      = $this->model::orderBy('id','desc')->get();
        $customers =  Customer::get();
        return view('backend.sales.invoices.index',compact('routeName','customers','rows'));

    }//end of index

    public function create(){
        $routeName ='sales';
        $taxes     = DB::table('taxes')->get();
        $customers = Customer::get();
        $stores    = StoStore::get();
        $units     = StoUnit::get();
        $banks     = FinBank::all('id','title_en');
         return view('backend.sales.invoices.create',compact('routeName','banks','taxes','customers','stores','units') );
    }// end of create

    public function getDeliversToCreateInvoice($customer){
        $deliversData = SalDeliver::where(
            [
                ['customer_id',$customer],
                ['sal_invoice_id', '=', null]
            ])->with('items')->get();
       // dd($receivesData);

        return view('backend.sales.invoices.parts.show_delivers', compact('deliversData'));

    }// end of getReceivesToCreateInvoice

    public function getDeliversItemsToCreateInvoice($items){

        $explode_id        = array_map('intval', explode(',', $items));
        $deliversItemsData = SalDeliverDetail::
                                select('item_id','unit_id', DB::raw('sum(qunatity)as qunatity'))
                                ->whereIn('deliver_id',$explode_id)
                                ->groupBy('item_id')
                                ->with('item','unit')->get();
        return view('backend.sales.invoices.parts.delivers_items', compact('deliversItemsData'));
    }// end of getReceivesItemsToCreateInvoice

    public function store($request){
       // dd($request->all());
        $request->validate([
            'reference_no'    => 'required',
            'customer_id'     => 'required|exists:customers,id' ,
            'store_id'        => 'required|exists:sto_stores,id' ,
            'date'            => 'required',
        ]);

        $totalQty         = array_sum($request->qty);
        $itemCount        = count($request->qty);
        $taxRate          = $request->invoice_tax ;
        $orderTax         = $request->invoice_tax_amount;
        $totalCost        = array_sum($request->sale_price);
        $totalDiscount    = $request->invoice_discount_amount;
        $totalTax         = $request->invoice_tax_amount + array_sum($request->item_tax_amount);


        if($request->invoice_payment_type == 1 || $request->paid_amount == $request->grand_total){
            $paid   = 1;
            $status = 1;
        }elseif($request->invoice_payment_type == 2){
            $paid   = 0;
            $status = 2;
        }elseif($request->invoice_payment_type == 3){
            $paid   = 0;
            $status = 3;
        }else{
            $paid   = 0;
            $status = 0;
        }

        if($request->document){
            $fileName = time().'.'.$request->document->extension();
            $request->document->move(public_path('uploads/purchases/invoices'), $fileName);
            $document =  $fileName ;
        }else{
            $document = "";
        }

        $monyId = 31;
        $requestArray = ['added_by' => Auth::id(),'money_id'=> $monyId ,'items_count' => $itemCount,
        'total_qty'=> $totalQty,'order_tax_rate'=>$taxRate,'order_tax'=>$orderTax,'status' => $status,
        'total_cost'=>$totalCost,'total_discount'=>$totalDiscount,'total_tax'=>$totalTax,'is_paid'=>$paid,
        'document'=> $document] + $request->all();

        $row =  $this->model->create($requestArray);

        // save details

        for ($i=0; $i < count($request->item_id); $i++) {
            if (isset($request->qty[$i]) && isset($request->sale_price[$i])) {
                SalInvoiceDetail::create([
                    'sal_invoice_id'    => $row->id,
                    'item_id'           => $request->item_id[$i],
                    'qunatity'          => $request->qty[$i],
                    'unit_price'        => $request->sale_price[$i],
                    'tax_rate'          => $request->item_tax_rate[$i] ,
                    'tax'               => $request->item_tax_amount[$i],
                    'discount'          => $request->disc_value[$i],
                    'discount_type'     => $request->disc_type[$i],
                    'sale_unit_id'      => $request->sale_unit_id[$i],
                    'total'             => $request->total_line_price[$i],
                ]);
            }
        }

         //handel item Delivers
         if($request->is_received == 1){
            $saleId =  $row->id ;
            $this->handelDeliverItems($request,$saleId);
        }//end of handel item received


        //handel customer balance


         //add new payment bank_transfare_fees    check_receive_date check_due_date document_code
         if($request->invoice_payment_type == 1 || $request->invoice_payment_type == 2){

            if($request->pay_type == 'check'){
                $receiveDate  = $request->created_date;
                $dueDate      = $request->due_date;
                $documentCode = $request->document_code;
                $bank         = $request->bank_id;
                $transfare_fees = 0;
            }elseif($request->pay_type == 'transfare'){
                $receiveDate  = '';
                $dueDate      = $request->due_date;
                $documentCode = $request->document_code;
                $bank         = $request->bank_id;
                $transfare_fees= $request->bank_transfare_fees;
            }else{
                $receiveDate = '';
                $dueDate = '';
                $documentCode = '';
                $bank         = '';
                $transfare_fees = 0;
            }

            $newPayment = FinTransaction::create([
                'belong'         => 'customer',
                'type'           => 'credit',
                'paying_method'  => $request->pay_type,
                'ref'            => $row->reference_no ,
                'code'           => transactionCode(),
                'amount'         => $request->paid_amount,
                'customer_id'    => $request->customer_id,
                'sale_id'        => $row->id ,
                'check_receive_date' => $receiveDate,
                'due_date'       => $dueDate ,
                'document_code'  => $documentCode,
                'created_by'     => Auth::id(),
                'bank_id'        => $bank,
                'bank_transfare_fees'=>$transfare_fees,
                'notes'          => 'Payment was made during invoice registration / تم الدفع اثناء تسجيل الفاتورة'
            ]);

            if($request->pay_type == 'check'){
                $transaction = $newPayment->id;
                $blong       = 'customer';
                $beneficiary = $request->customer_id;
                $type        = 'receivable';
                $this->createCheck($transaction,$request ,$blong ,$beneficiary,$type);
            }

        }
        // handel journal details

        $setting            = 'setting';
        $direct             = 'direct';
        $customerAccountId  = Customer::select('id','account_id')->where('id',$request->customer_id)->first();
        $customerKey        = $customerAccountId->account_id;
        $bankAccountId      = FinBank::select('id','account_id')->where('id',$request->bank_id)->first();
        $bankKey            = $bankAccountId->account_id;

        if( setting('inventory_type') == 1)
        {
            // dd('جرد مستمر');
            if($request->invoice_payment_type == 1)
            {
                //cash_payment

                //handel master journal
                $details = "بيع بضاعة نقدا";
                $jornal =   $this->handelJournal($request,$details);

                // handel debit value
                // handel TaxDeductCollect account
                $taxComIndust = 'TaxCommercialIndustrial';
                $taxDeductCollectAmount = $request->deduction_tax_amount;
                $this->handelJournalDetailsDebit($taxComIndust,$jornal,$taxDeductCollectAmount,$setting);

                // handel cash account
                if($request->pay_type == 'cash'){
                    $cashKey = 'Cash';
                    $casAmount = $request->paid_amount;
                    $this->handelJournalDetailsDebit($cashKey,$jornal,$casAmount,$setting);

                }elseif($request->pay_type == 'transfare'){

                    $casAmount = $request->paid_amount;
                    $this->handelJournalDetailsDebit($bankKey,$jornal,$casAmount,$direct);

                }elseif($request->pay_type == 'check'){
                    $cashKey = 'NotesReceivables';
                    $casAmount = $request->paid_amount;
                    $this->handelJournalDetailsDebit($cashKey,$jornal,$casAmount,$setting);

                }

                    // handel credit value

                // handel sales account
                $salesKey = 'SalesMaster';
                $salesAmount = $request->sub_total_after_discount;
                $this->handelJournalDetailsCridet($salesKey,$jornal,$salesAmount,$setting);

                // handel added tax value
                $addedTaxKey = 'AddedTaxValue';
                $addedTaxAmount = $request->invoice_tax_amount;
                $this->handelJournalDetailsCridet($addedTaxKey,$jornal,$addedTaxAmount,$setting);

                //handel SalesExpense and shipping cost
                $salesExpenseKey    = 'ShipmentCost';
                $salesExpenseAmount = $request->shipping_cost;
                $this->handelJournalDetailsCridet($salesExpenseKey,$jornal,$salesExpenseAmount,$setting);
            }
            elseif($request->invoice_payment_type == 2)
            {
                //fees_payment
                //handel master journal
                $details = "بيع بضاعة ودفع جزء مقدم";
                $jornal =   $this->handelJournal($request,$details);
                // handel debit value
                // handel TaxDeductCollect account
                $taxComIndusKey = 'TaxCommercialIndustrial';
                $taxComIndusAmount = $request->deduction_tax_amount;
                $this->handelJournalDetailsDebit($taxComIndusKey,$jornal,$taxComIndusAmount,$setting);

                // handel cash account
                if($request->pay_type == 'cash'){
                    $cashKey = 'Cash';
                    $casAmount = $request->paid_amount;
                    $this->handelJournalDetailsDebit($cashKey,$jornal,$casAmount,$setting);

                }elseif($request->pay_type == 'transfare'){

                    $casAmount = $request->paid_amount;
                    $this->handelJournalDetailsDebit($bankKey,$jornal,$casAmount,$direct);

                }elseif($request->pay_type == 'check'){
                    $cashKey = 'NotesReceivables';
                    $casAmount = $request->paid_amount;
                    $this->handelJournalDetailsDebit($cashKey,$jornal,$casAmount,$setting);

                }



                // handel cash account
                $customerAmount = $request->remaining_amount;
                $this->handelJournalDetailsDebit($customerKey,$jornal,$customerAmount,$direct);

                // handel credit value
                // handel sales account
                $salesKey = 'SalesMaster';
                $salesAmount = $request->sub_total_after_discount;
                $this->handelJournalDetailsCridet($salesKey,$jornal,$salesAmount,$setting);

                    // handel added tax value
                $addedTaxKey = 'AddedTaxValue';
                $addedTaxAmount = $request->invoice_tax_amount;
                $this->handelJournalDetailsCridet($addedTaxKey,$jornal,$addedTaxAmount,$setting);

                //handel SalesExpense and shipping cost
                $salesExpense = 'SalesExpense';
                $salesExpenseAmount = $request->shipping_cost;
                $this->handelJournalDetailsCridet($salesExpense,$jornal,$salesExpenseAmount,$setting);

            }
            elseif($request->invoice_payment_type == 3 )
            {
                //deferred_payment
                //handel master journal
                $details = "بيع بضاعة اجل";
                $jornal =   $this->handelJournal($request,$details);

                // handel debit value
                // handel TaxDeductCollect account
                $taxComIndusKey = 'TaxCommercialIndustrial';
                $taxComIndusAmount = $request->deduction_tax_amount;
                $this->handelJournalDetailsDebit($taxComIndusKey,$jornal,$taxComIndusAmount,$setting);

                // handel custommer account
                $customerAmount = $request->remaining_amount;
                $this->handelJournalDetailsDebit($customerKey,$jornal,$customerAmount,$direct);
                // handel credit value
                // handel purchse account
                $salesKey = 'SalesMaster';
                $salesAmount = $request->sub_total_after_discount;
                $this->handelJournalDetailsCridet($salesKey,$jornal,$salesAmount,$setting);

                // handel added tax value
                $addedTaxKey = 'AddedTaxValue';
                $addedTaxAmount = $request->invoice_tax_amount;
                $this->handelJournalDetailsCridet($addedTaxKey,$jornal,$addedTaxAmount,$setting);

                //handel PurchaseExpenses and shipping cost
                $salesExpense = 'SalesExpense';
                $salesExpenseAmount = $request->shipping_cost;
                $this->handelJournalDetailsCridet($salesExpense,$jornal,$salesExpenseAmount,$setting);


            }
        }// end of inventory type 1

        elseif(setting('inventory_type') == 2)
        {
                //dd('جرد دوري');
            if($request->invoice_payment_type == 1){
            //cash_payment
            //handel master journal
            $details = "بيع بضاعة نقدا";
            $jornal =   $this->handelJournal($request,$details);

            // handel debit value

            // handel cash account
            if($request->pay_type == 'cash'){
                $cashKey = 'Cash';
                $casAmount = $request->paid_amount;
                $this->handelJournalDetailsDebit($cashKey,$jornal,$casAmount,$setting);

            }elseif($request->pay_type == 'transfare'){

                $casAmount = $request->paid_amount;
                $this->handelJournalDetailsDebit($bankKey,$jornal,$casAmount,$direct);

            }elseif($request->pay_type == 'check'){
                $cashKey = 'NotesReceivables';
                $casAmount = $request->paid_amount;
                $this->handelJournalDetailsDebit($cashKey,$jornal,$casAmount,$setting);

            }



            // handel TaxCommercialIndustrial account
            $taxCommercialIndustrialtKey = 'TaxCommercialIndustrial';
            $taxtaxCommercialIndustrialtKeyAmount = $request->deduction_tax_amount;
            $this->handelJournalDetailsDebit($taxCommercialIndustrialtKey,$jornal,$taxtaxCommercialIndustrialtKeyAmount, $setting);


            // handel credit value
            // handel sales account
            $salesKey       = 'SalesMaster';
            $salesAmount    = $request->sub_total_after_discount;
            $this->handelJournalDetailsCridet($salesKey,$jornal,$salesAmount, $setting);

            // handel added tax value
            $addedTaxKey = 'AddedTaxValue';
            $addedTaxAmount = $request->invoice_tax_amount;
            $this->handelJournalDetailsCridet($addedTaxKey,$jornal,$addedTaxAmount, $setting);

            //handel SalesExpense and shipping cost
            $salesExpenseKey = 'ShipmentCost';
            $salesExpenseAmount = $request->shipping_cost;
            $this->handelJournalDetailsCridet($salesExpenseKey,$jornal,$salesExpenseAmount, $setting);

            }elseif($request->invoice_payment_type == 2){
                //fees_payment

                //handel master journal
                $details = "بيع بضاعة ودفع جزء مقدم";
                $jornal =   $this->handelJournal($request,$details);


                // handel debit value

                // handel TaxDeductCollect account
                $taxCommercialIndustrialtKey = 'TaxCommercialIndustrial';
                $taxtaxCommercialIndustrialtKeyAmount = $request->deduction_tax_amount;
                $this->handelJournalDetailsDebit($taxCommercialIndustrialtKey,$jornal,$taxtaxCommercialIndustrialtKeyAmount, $setting);

                // handel cash account
                if($request->pay_type == 'cash'){
                    $cashKey = 'Cash';
                    $casAmount = $request->paid_amount;
                    $this->handelJournalDetailsDebit($cashKey,$jornal,$casAmount,$setting);

                }elseif($request->pay_type == 'transfare'){

                    $casAmount = $request->paid_amount;
                    $this->handelJournalDetailsDebit($bankKey,$jornal,$casAmount,$direct);

                }elseif($request->pay_type == 'check'){
                    $cashKey = 'NotesReceivables';
                    $casAmount = $request->paid_amount;
                    $this->handelJournalDetailsDebit($cashKey,$jornal,$casAmount,$setting);

                }

                // handel cash account

                $customerAmount = $request->remaining_amount;
                $this->handelJournalDetailsDebit($customerKey,$jornal,$customerAmount,$direct);

                // handel credit value
                // handel purchse account
                $salesKey       = 'SalesMaster';
                $salesAmount    =  $request->sub_total_after_discount;
                $this->handelJournalDetailsCridet($salesKey,$jornal,$salesAmount, $setting);

                // handel added tax value
                $addedTaxKey = 'AddedTaxValue';
                $addedTaxAmount = $request->invoice_tax_amount;
                $this->handelJournalDetailsCridet($addedTaxKey,$jornal,$addedTaxAmount, $setting);

                //handel PurchaseExpenses and shipping cost
                $salesExpenseKey = 'ShipmentCost';
                $salesExpenseAmount = $request->shipping_cost;
                $this->handelJournalDetailsCridet($salesExpenseKey,$jornal,$salesExpenseAmount, $setting);


            }elseif($request->invoice_payment_type == 3 ){
                //deferred_payment

                //handel master journal
                $details = "بيع بضاعة اجل";
                $jornal =   $this->handelJournal($request,$details);

                // handel debit value

                // handel TaxDeductCollect account
                $taxCommercialIndustrialtKey = 'TaxCommercialIndustrial';
                $taxtaxCommercialIndustrialtKeyAmount = $request->deduction_tax_amount;
                $this->handelJournalDetailsDebit($taxCommercialIndustrialtKey,$jornal,$taxtaxCommercialIndustrialtKeyAmount, $setting);

                // handel customer account

                $customerAmount = $request->remaining_amount;
                $this->handelJournalDetailsDebit($customerKey,$jornal,$customerAmount,$direct);


                // handel credit value
                // handel sales account
                $salesKey       = 'SalesMaster';
                $salesAmount    =  $request->sub_total_after_discount;
                $this->handelJournalDetailsCridet($salesKey,$jornal,$salesAmount, $setting);

                // handel added tax value
                $addedTaxKey = 'AddedTaxValue';
                $addedTaxAmount = $request->invoice_tax_amount;
                $this->handelJournalDetailsCridet($addedTaxKey,$jornal,$addedTaxAmount, $setting);

                //handel PurchaseExpenses and shipping cost
                $salesExpenseKey = 'ShipmentCost';
                $salesExpenseAmount =$request->shipping_cost;
                $this->handelJournalDetailsCridet($salesExpenseKey,$jornal,$salesExpenseAmount, $setting);
            }
        }

        if( config('app.locale') == 'ar'){ alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Created Successfully', 'Good Work'); }
        return redirect()->route('dashboard.sales.index');
    }// end of store

    protected function handelJournal($request,$details){

        $jornal =  FinJournal::create([
            'user_id'   => Auth::user()->id,
            'ref'       => date("shdmy"),
            'date'      => $request->date,
            'details'   => $details,
            'attachment'=> '',

        ]);

        $jornal =  $jornal->id;
        return $jornal ;

    }// end of handelJournal

    protected function handelJournalDetailsCridet($accountKey,$jornal,$amount,$type){
        if($type == 'setting'){
            $account      =  FinSetting::where('account_key' , '=' , $accountKey)->first();
            $accountId    = $account->account_id ;
        }elseif($type == 'direct'){
            $accountId  = $accountKey;
        }


        FinJournalDetail::create([
            'journal_id'=> $jornal,
            'account_id'=> $accountId ,
            'credit'=>$amount,
            'debit'=>0,
        ]);

        return 1;
    } //end of handelJournalDetails Cridet

    protected function handelJournalDetailsDebit($accountKey,$jornal,$amount,$type){

        if($type == 'setting'){
            $account      =  FinSetting::where('account_key' , '=' , $accountKey)->first();
            $accountId    = $account->account_id ;
        }elseif($type == 'direct'){
            $accountId  = $accountKey;
        }

        $account      =  FinSetting::where('account_key' , '=' , $accountKey)->first();

        FinJournalDetail::create([
            'journal_id'=> $jornal,
            'account_id'=>  $accountId,
            'credit'    => 0,
            'debit'     => $amount,
        ]);

        return 1;

    } //end of handelJournalDetails Debit

    protected function handelDeliverItems($request , $saleId){

        $totalQty         = array_sum($request->qty);
        $itemCount        = count($request->item_id);

        //save new deliver
        $requestArray = ['added_by' => Auth::id(),
                         'items_count' => $itemCount,
                         'total_qty'=> $totalQty,
                        ] + $request->all();

        $row =  SalDeliver::create($requestArray);

        // save deliver details
        for ($i=0; $i < count($request->item_id); $i++) {
            if (isset($request->qty[$i])) {
                SalDeliverDetail::create([
                    'deliver_id'        => $row->id,
                    'item_id'           => $request->item_id[$i],
                    'qunatity'          => $request->qty[$i],
                    'unit_id'           => $request->sale_unit_id[$i],
                ]);
            }
        }// end of save details

        // handel decrease qty
        for ($b=0; $b < count($request->item_id); $b++) {
            if (isset($request->qty[$b])) {
                $item = StoQuantity::where([
                    ['store_id', '=', $request->store_id],
                    ['item_id', '=' ,$request->item_id[$b]]])
                    ->first();

                    $newQty = $item->quantity - $request->qty[$b] ;
                    StoQuantity::where("id", $item->id)->update(["quantity" => $newQty]);

            }
        }// end of save qunatity

        // handel items cards
        for ($c=0; $c < count($request->item_id); $c++) {
            if (isset($request->qty[$c])) {
                StoItemCard::create([
                    'sale_id'       => $saleId,
                    'delivery_id'   => $row->id,
                    'store_id'      => $request->store_id,
                    'item_id'       => $request->item_id[$c],
                    'quantity_out'  => $request->qty[$c],
                    'price_out'     => $request->sale_price[$c],
                    'value_out'     => $request->qty[$c] * $request->sale_price[$c],
                    'description'   => 'عملية بيع',
                    'type'          => 'sale',
                ]);
            }
        }


    }//  end of handelDeliverItems

    protected function createCheck($transaction,$request ,$blong ,$beneficiary,$type){

        FinCheck::create([
            'transaction_id'  => $transaction ,
            'bank_id'         => $request->bank_id,
            'belong_to'       => $blong ,
            'beneficiary'     => $beneficiary ,
            'release_date'    => $request->created_date ,
            'due_date'        => $request->due_date,
            'check_number'    => $request->document_code ,
            'amount'          => $request->paid_amount ,
            'type'            => $type,
            'status'          => 0,
            'notes'           => $request->notes
        ]);
    }// end of create check

    public function edit($id){

    }// end of edit

    public function update($request,$id){
       $request->validate([
            'account_id'=> 'required',
            'account_key'=>'required',
        ]);

        $account_id = $request->account_id;
        $account_key = $request->account_key;
        $setting_id = $request->setting_id;
        $count = count($request->setting_id);

        for($i = 0; $i < $count; $i++){
          $FinAccount =  FinAccount::where('id',$account_id[$i])->first();
          $row =  $this->model->FindOrFail($setting_id[$i]);
          $row->update([
                'user_id'=>Auth::user()->id,
                'title_ar'=>$FinAccount->title_ar,
                'title_en'=>$FinAccount->title_en,
                'account_id'=>$account_id[$i],
                'account_key'=>$account_key[$i],
            ]);
        }

        if( config('app.locale') == 'ar'){
            alert()->success('تم تعديل الاعدادات  بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Settings Updated Successfully', 'Good Work');
        }
        return redirect()->back();


    }// end of update

    public function destroy($id){

        //dd($id);
        $this->model::FindOrFail($id)->delete();

        if( config('app.locale') == 'ar'){
            alert()->success('تم حذف بيانات السجل بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Deleted Successfully', 'Good Work');
        }
        return redirect()->back();

    }// end of destroy
    public function search($value,$id){
        $StoItem =  StoItem::where(function ($query) use ($value){
                         $query->where('title_en', 'LIKE', '%'.$value.'%')
                             ->orWhere('title_ar', 'LIKE', '%'.$value.'%');
                     })->get();
     return view('backend.sales.invoices.search', compact('StoItem','id'));


     }// end of search
} // end of class

?>
