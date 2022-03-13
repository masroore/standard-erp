<?php
namespace App\Http\Repositories\Purchases;
use App\Models\Supplier;
use App\Models\Purchase\BuyPurchaseInvoice;
use App\Http\Interfaces\Purchases\PurchaseInvoiceInterface;
use App\Models\Finance\FinAccount;
use App\Models\Finance\FinBank;
use App\Models\Finance\FinCheck;
use App\Models\Finance\FinJournal;
use App\Models\Finance\FinJournalDetail;
use App\Models\Finance\FinSetting;
use App\Models\Finance\FinTransaction;
use App\Models\Purchase\BuyOperation;
use App\Models\Purchase\BuyPurchaseInvoiceDetail;
use App\Models\Purchase\BuyReceive;
use App\Models\Purchase\BuyReceiveDetail;
use App\Models\Settings\Tax;
use App\Models\Store\StoItem;
use App\Models\Store\StoItemCard;
use App\Models\Store\StoQuantity;
use App\Models\Store\StoStore;
use App\Models\Store\StoUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Image;

class PurchaseInvoiceRepository  implements PurchaseInvoiceInterface
{
    private $model;

    public function __construct(BuyPurchaseInvoice $buyPurchaseInvoice)
    {
        $this->model = $buyPurchaseInvoice;
    }// end of construct

    public function index(){
        $suppliers = Supplier::select('id','contact_person', 'company_name')->get();
        $rows      = $this->model::select('id','reference_no','date',
                                            'supplier_id','grand_total',
                                            'remaining_amount','is_paid')
                                        ->with('supplier:company_name,id')
                                        ->get();

        return view('backend.purchases.invoices.index', compact('rows','suppliers'));
    }//end of index

    public function show($id){
        $row =  $this->model::where('id', $id)->with('supplier','store','items')->first();
        return view('backend.purchases.invoices.show', compact('row'));
    }//end of show

    public function create($request){
        if($request->operration_id){
            $operation = $request->operration_id ;
        }else{
            $operation = null;
        }
        $suppliers = Supplier::get();
        $taxes     = Tax::get();
        $stores    = StoStore::get();
        $units     = StoUnit::get();
        $banks     = FinBank::all('id','title_en');
        $routeName = 'purchases';
        return view('backend.purchases.invoices.create', compact('suppliers','banks','taxes','routeName','stores','units','operation'));
    }//e nd of create

    public function search($value,$id){
        $StoItem =  StoItem::where(function ($query) use ($value){
                         $query->where('title_en', 'LIKE', '%'.$value.'%')
                             ->orWhere('title_ar', 'LIKE', '%'.$value.'%')
                             ->orWhere('code', 'LIKE', '%'.$value.'%');
                     })->get();

     return view('backend.purchases.invoices.search', compact('StoItem','id'));


    }// end of search

    public function getReceivesToCreateInvoice($supplier){
        $receivesData = BuyReceive::where(
            [
                ['supplier_id',$supplier],
                ['purchase_invoice_id', '=', null]
            ])->with('items')->get();
       // dd($receivesData);

        return view('backend.purchases.invoices.parts.show_recevies', compact('receivesData'));

    }// end of getReceivesToCreateInvoice

    public function getReceivesItemsToCreateInvoice($items){

        $explode_id        = array_map('intval', explode(',', $items));
        $receivesItemsData = BuyReceiveDetail::
                                select('item_id','purchase_unit_id', FacadesDB::raw('sum(qunatity)as qunatity'))
                                ->whereIn('receive_id',$explode_id)
                                ->groupBy('item_id')
                                ->with('item','unit')->get();
        $units     = StoUnit::get();
        $taxes     = Tax::get();
        //dd($receivesItemsData);
        return view('backend.purchases.invoices.parts.receivecs_items', compact('receivesItemsData','units','taxes'));
    }// end of getReceivesItemsToCreateInvoice

    public function edit($id){

        $row =   $this->model::FindOrFail($id);
        return view('backend.purchases.invoices.edit', compact('row'));
    }// end of edit

    public function store($request){

        $request->validate([
            'reference_no'    => 'required',
            'supplier_id'     => 'required|exists:suppliers,id' ,
            'store_id'        => 'required|exists:sto_stores,id' ,
            'date'            => 'required',
        ]);

        $totalQty         = array_sum($request->qty);
        $itemCount        = count($request->qty);
        $taxRate          = $request->invoice_tax ;
        $orderTax         = $request->invoice_tax_amount;
        $totalCost        = array_sum($request->purch_price);
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

        //dd($paid . '=> status'.$status );

        if($request->document){
            $fileName = time().'.'.$request->document->extension();
            $request->document->move(public_path('uploads/purchases/invoices'), $fileName);
            $document =  $fileName ;
        }else{
            $document = "";
        }

        $requestArray = ['added_by' => Auth::id(),'money_id'=> 31, 'items_count' => $itemCount,
        'total_qty'=> $totalQty,'order_tax_rate'=>$taxRate,'order_tax'=>$orderTax,'status' => $status ,
        'total_cost'=>$totalCost,'total_discount'=>$totalDiscount,'total_tax'=>$totalTax,'is_paid'=>$paid,
        'document'=> $document] + $request->all();

        $row =  $this->model->create($requestArray);

        // save details
        for ($i=0; $i < count($request->item_id); $i++) {
            if (isset($request->qty[$i]) && isset($request->purch_price[$i])) {
                BuyPurchaseInvoiceDetail::create([
                    'buy_invoice_id'    => $row->id,
                    'item_id'           => $request->item_id[$i],
                    'qunatity'          => $request->qty[$i],
                    'unit_price'        => $request->purch_price[$i],
                    'tax_rate'          => $request->item_tax_rate[$i] ,
                    'tax'               => $request->item_tax_amount[$i],
                    'discount'          => $request->disc_value[$i],
                    'discount_type'     => $request->disc_type[$i],
                    'purchase_unit_id'  => $request->purchase_unit_id[$i],
                    'total'             => $request->total_line_price[$i],
                ]);
            }
        }

        //handel item received
        if($request->is_received == 1){
            $purcheId =  $row->id ;
            $this->handelReceiveItems($request,$purcheId);
        }//end of handel item received

        // handel payments

        //handel supplier balance
        if($request->invoice_payment_type == 3 || $request->invoice_payment_type == 2){
            $this->updateSuppllierBalance($request);
        } // end of update supplier balance

        //add new payment
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
                'belong'         => 'supplier',
                'type'           => 'debit',
                'paying_method'  => $request->pay_type,
                'ref'            => $row ->reference_no ,
                'code'           => transactionCode(),
                'amount'         => $request->paid_amount,
                'supplier_id'    => $request->supplier_id,
                'purch_id'       => $row->id ,
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
                $blong       = 'supplier';
                $beneficiary = $request->supplier_id;
                $type        = 'payable';
                $amount      = $request->paid_amount;
                $this->createCheck($transaction,$request ,$blong ,$beneficiary,$type,$amount);
            }

        }

        // handel journal details
        $setting            = 'setting';
        $direct             = 'direct';
        $supplierAccountId  = Supplier::select('id','account_id')->where('id',$request->supplier_id)->first();
        $supplierKey        = $supplierAccountId->account_id;
        if($request->bank_id){
            $bankAccountId      = FinBank::select('id','account_id')->where('id',$request->bank_id)->first();
            $bankKey            = $bankAccountId->account_id;
        }

        if( setting('inventory_type') == 1){
            // dd('جرد مستمر');
                if($request->invoice_payment_type == 1)
                {
                    //cash_payment

                    //handel master journal
                    $details = "شراء بضاعة نقدا";
                    $jornal =   $this->handelJournal($request,$details);

                    // handel  debit value

                    // handel purchse account
                    $purchaseKey = 'Store';
                    $purchaseAmount = $request->sub_total_after_discount;
                    $this->handelJournalDetailsDebit($purchaseKey,$jornal,$purchaseAmount,$setting);

                    // handel added tax value
                    $addedTaxKey = 'AddedTaxValue';
                    $addedTaxAmount = $request->invoice_tax_amount;
                    $this->handelJournalDetailsDebit($addedTaxKey,$jornal,$addedTaxAmount,$setting);

                    //handel PurchaseExpenses and shipping cost
                    $purchaseExpenseKey = 'PurchaseExpenses';
                    $purchaseExpenseAmount = $request->shipping_cost;
                    $this->handelJournalDetailsDebit($purchaseExpenseKey,$jornal,$purchaseExpenseAmount,$setting);

                    // handel credit value

                    // handel TaxDeductCollect account
                    $taxDeductCollectKey = 'TaxDeductCollect';
                    $taxDeductCollectAmount = $request->deduction_tax_amount;
                    $this->handelJournalDetailsCridet($taxDeductCollectKey,$jornal,$taxDeductCollectAmount,$setting);

                    // handel cash account $bankKey
                    if($request->pay_type == 'cash'){
                        $cashKey = 'Cash';
                        $casAmount = $request->paid_amount;
                        $this->handelJournalDetailsCridet($cashKey,$jornal,$casAmount,$setting);

                    }elseif($request->pay_type == 'transfare'){
                        $casAmount = $request->paid_amount;
                        $this->handelJournalDetailsCridet($bankKey,$jornal,$casAmount,$direct);

                        if($request->bank_transfare_fees){
                            $bankExpenseKey = 'BankExpenses';
                            $banExpenseAmount = $request->bank_transfare_fees;
                            $this->handelJournalDetailsDebit($bankExpenseKey,$jornal,$banExpenseAmount,$setting);
                        }
                    }elseif($request->pay_type == 'check'){
                        $cashKey = 'PayPaper';
                        $casAmount = $request->paid_amount;
                        $this->handelJournalDetailsCridet($cashKey,$jornal,$casAmount,$setting);

                    }



                }
                elseif($request->invoice_payment_type == 2)
                {
                    //fees_payment

                    //handel master journal
                    $details = "شراء بضاعة ودفع جزء مقدم";
                    $jornal =   $this->handelJournal($request,$details);

                    // handel debit value
                    // handel purchse account
                    $purchaseKey = 'Store';
                    $purchaseAmount = $request->sub_total_after_discount;
                    $this->handelJournalDetailsDebit($purchaseKey,$jornal,$purchaseAmount,$setting);

                        // handel added tax value
                    $addedTaxKey = 'AddedTaxValue';
                    $addedTaxAmount = $request->invoice_tax_amount;
                    $this->handelJournalDetailsDebit($addedTaxKey,$jornal,$addedTaxAmount,$setting);

                    //handel PurchaseExpenses and shipping cost
                    $purchaseExpenseKey = 'PurchaseExpenses';
                    $purchaseExpenseAmount = $request->shipping_cost;
                    $this->handelJournalDetailsDebit($purchaseExpenseKey,$jornal,$purchaseExpenseAmount,$setting);

                    // handel credit value

                    // handel TaxDeductCollect account
                    $taxDeductCollectKey = 'TaxDeductCollect';
                    $taxDeductCollectAmount = $request->deduction_tax_amount;
                    $this->handelJournalDetailsCridet($taxDeductCollectKey,$jornal,$taxDeductCollectAmount,$setting);

                    // handel cash account
                    if($request->pay_type == 'cash'){
                        $cashKey = 'Cash';
                        $casAmount = $request->paid_amount;
                        $this->handelJournalDetailsCridet($cashKey,$jornal,$casAmount,$setting);

                    }elseif($request->pay_type == 'transfare'){

                        if($request->bank_transfare_fees){
                            $bankExpenseKey = 'BankExpenses';
                            $banExpenseAmount = $request->bank_transfare_fees;
                            $this->handelJournalDetailsDebit($bankExpenseKey,$jornal,$banExpenseAmount,$setting);
                        }
                        $casAmount = $request->paid_amount + $request->bank_transfare_fees;
                        $this->handelJournalDetailsCridet($bankKey,$jornal,$casAmount,$direct);

                    }elseif($request->pay_type == 'check'){
                        $cashKey = 'PayPaper';
                        $casAmount = $request->paid_amount;
                        $this->handelJournalDetailsCridet($cashKey,$jornal,$casAmount,$setting);

                    }



                    $supplierAmount = $request->remaining_amount;
                    $this->handelJournalDetailsCridet($supplierKey,$jornal,$supplierAmount,$direct);
                }
                elseif($request->invoice_payment_type == 3 )
                {
                        //deferred_payment

                    //handel master journal
                    $details = "شراء بضاعة اجل";
                    $jornal =   $this->handelJournal($request,$details);

                    // handel credit value

                    // handel purchse account
                    $purchaseKey = 'Store';
                    $purchaseAmount = $request->sub_total_after_discount;
                    $this->handelJournalDetailsDebit($purchaseKey,$jornal,$purchaseAmount,$setting);

                    // handel added tax value
                    $addedTaxKey = 'AddedTaxValue';
                    $addedTaxAmount = $request->invoice_tax_amount;
                    $this->handelJournalDetailsDebit($addedTaxKey,$jornal,$addedTaxAmount,$setting);

                    //handel PurchaseExpenses and shipping cost
                    $purchaseExpenseKey = 'PurchaseExpenses';
                    $purchaseExpenseAmount = $request->shipping_cost;
                    $this->handelJournalDetailsDebit($purchaseExpenseKey,$jornal,$purchaseExpenseAmount,$setting);


                    // handel credit value
                    // handel TaxDeductCollect account
                    $taxDeductCollectKey = 'TaxDeductCollect';
                    $taxDeductCollectAmount = $request->deduction_tax_amount;
                    $this->handelJournalDetailsCridet($taxDeductCollectKey,$jornal,$taxDeductCollectAmount,$setting);

                    // handel Supplier account

                    $supplierAmount = $request->remaining_amount;
                    $this->handelJournalDetailsCridet($supplierKey,$jornal,$supplierAmount,$direct);
                }

        }// end of inventory type 1
        elseif(setting('inventory_type') == 2){
            //dd('جرد دوري');
            if($request->invoice_payment_type == 1){
                //cash_payment

                //handel master journal
                $details = "شراء بضاعة نقدا";
                $jornal =   $this->handelJournal($request,$details);

                // handel debit value

                // handel purchse account
                $purchaseKey = 'PurchasesMaster';
                $purchaseAmount = $request->sub_total_after_discount;
                $this->handelJournalDetailsDebit($purchaseKey,$jornal,$purchaseAmount, $setting);

                // handel added tax value
                $addedTaxKey = 'AddedTaxValue';
                $addedTaxAmount = $request->invoice_tax_amount;
                $this->handelJournalDetailsDebit($addedTaxKey,$jornal,$addedTaxAmount, $setting);

                //handel PurchaseExpenses and shipping cost
                $purchaseExpenseKey = 'PurchaseExpenses';
                $purchaseExpenseAmount = $request->shipping_cost;
                $this->handelJournalDetailsDebit($purchaseExpenseKey,$jornal,$purchaseExpenseAmount, $setting);

                // handel credit value
                // handel TaxDeductCollect account
                $taxDeductCollectKey = 'TaxDeductCollect';
                $taxDeductCollectAmount = $request->deduction_tax_amount;
                $this->handelJournalDetailsCridet($taxDeductCollectKey,$jornal,$taxDeductCollectAmount, $setting);

                // handel cash account
                if($request->pay_type == 'cash'){
                    $cashKey = 'Cash';
                    $casAmount = $request->paid_amount;
                    $this->handelJournalDetailsCridet($cashKey,$jornal,$casAmount,$setting);

                }elseif($request->pay_type == 'transfare'){

                    if($request->bank_transfare_fees){
                        $bankExpenseKey = 'BankExpenses';
                        $banExpenseAmount = $request->bank_transfare_fees;
                        $this->handelJournalDetailsDebit($bankExpenseKey,$jornal,$banExpenseAmount,$setting);
                    }

                    $casAmount = $request->paid_amount;
                    $this->handelJournalDetailsCridet($bankKey,$jornal,$casAmount,$direct);

                }elseif($request->pay_type == 'check'){
                    $cashKey = 'PayPaper';
                    $casAmount = $request->paid_amount;
                    $this->handelJournalDetailsCridet($cashKey,$jornal,$casAmount,$setting);

                }

            }elseif($request->invoice_payment_type == 2){
                //fees_payment

                //handel master journal
                $details = "شراء بضاعة ودفع جزء مقدم";
                $jornal =   $this->handelJournal($request,$details);

                // handel debit value
                // handel purchse account
                $purchaseKey = 'PurchasesMaster';
                $purchaseAmount = $request->sub_total_after_discount;
                $this->handelJournalDetailsDebit($purchaseKey,$jornal,$purchaseAmount, $setting);

                // handel added tax value
                $addedTaxKey = 'AddedTaxValue';
                $addedTaxAmount = $request->invoice_tax_amount;
                $this->handelJournalDetailsDebit($addedTaxKey,$jornal,$addedTaxAmount, $setting);

                //handel PurchaseExpenses and shipping cost
                $purchaseExpenseKey = 'PurchaseExpenses';
                $purchaseExpenseAmount = $request->shipping_cost;
                $this->handelJournalDetailsDebit($purchaseExpenseKey,$jornal,$purchaseExpenseAmount, $setting);

                // handel credit value
                // handel TaxDeductCollect account
                $taxDeductCollectKey = 'TaxDeductCollect';
                $taxDeductCollectAmount = $request->deduction_tax_amount;
                $this->handelJournalDetailsCridet($taxDeductCollectKey,$jornal,$taxDeductCollectAmount, $setting);


                 // handel cash account
                if($request->pay_type == 'cash'){
                    $cashKey = 'Cash';
                    $casAmount = $request->paid_amount;
                    $this->handelJournalDetailsCridet($cashKey,$jornal,$casAmount,$setting);

                }elseif($request->pay_type == 'transfare'){

                    if($request->bank_transfare_fees){
                        $bankExpenseKey = 'BankExpenses';
                        $banExpenseAmount = $request->bank_transfare_fees;
                        $this->handelJournalDetailsDebit($bankExpenseKey,$jornal,$banExpenseAmount,$setting);
                    }
                    $casAmount = $request->paid_amount + $request->bank_transfare_fees;


                    $this->handelJournalDetailsCridet($bankKey,$jornal,$casAmount,$direct);

                }elseif($request->pay_type == 'check'){
                    $cashKey = 'PayPaper';
                    $casAmount = $request->paid_amount;
                    $this->handelJournalDetailsCridet($cashKey,$jornal,$casAmount,$setting);

                }
                // handel cash account

                $supplierAmount = $request->remaining_amount;
                $this->handelJournalDetailsCridet($supplierKey,$jornal,$supplierAmount,$direct);


            }elseif($request->invoice_payment_type == 3 ){
                //deferred_payment

                //handel master journal
                $details = "شراء بضاعة اجل";
                $jornal =   $this->handelJournal($request,$details);

                // handel debit value

                // handel purchse account
                $purchaseKey = 'PurchasesMaster';
                $purchaseAmount = $request->sub_total_after_discount;
                $this->handelJournalDetailsDebit($purchaseKey,$jornal,$purchaseAmount, $setting);

                // handel added tax value
                $addedTaxKey = 'AddedTaxValue';
                $addedTaxAmount = $request->invoice_tax_amount;
                $this->handelJournalDetailsDebit($addedTaxKey,$jornal,$addedTaxAmount, $setting);

                //handel PurchaseExpenses and shipping cost
                $purchaseExpenseKey = 'PurchaseExpenses';
                $purchaseExpenseAmount = $request->shipping_cost;
                $this->handelJournalDetailsDebit($purchaseExpenseKey,$jornal,$purchaseExpenseAmount, $setting);

                // handel credit value
                // handel TaxDeductCollect account
                $taxDeductCollectKey = 'TaxDeductCollect';
                $taxDeductCollectAmount = $request->deduction_tax_amount;
                $this->handelJournalDetailsCridet($taxDeductCollectKey,$jornal,$taxDeductCollectAmount, $setting);

                // handel Supplier account

                $supplierAmount = $request->remaining_amount;
                $this->handelJournalDetailsCridet($supplierKey,$jornal,$supplierAmount,$direct);


            }
        }// end of inventory type 2

        if($request->opration_id != null){
            BuyOperation::where("id", $request->opration_id)->update(["is_created_inv" => 1]);
        }
        if( config('app.locale') == 'ar'){ alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Created Successfully', 'Good Work'); }
        return redirect()->route('dashboard.purchases.index');


    }// end of store

    public function update($request,$id){

        $row =   $this->model::FindOrFail($id);

            $validation = Validator::make($request->all(),[

            ]);


        $requestArray =   ['' => $row] +$request->all() ;

        $row->update($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم تعديل السجل  بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Updated Successfully', 'Good Work');
        }
        return redirect()->route('dashboard.suppliers.index');
    }// end of update

    public function destroy($id){
        $this->model::FindOrFail($id)->delete();

        if( config('app.locale') == 'ar'){
            alert()->success('تم حذف بيانات السجل بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Deleted Successfully', 'Good Work');
        }
        return redirect()->back();

    }// end of destroy


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

    protected function handelReceiveItems($request,$purcheId){

        $totalQty         = array_sum($request->qty);
        $itemCount        = count($request->item_id);
        //save new receive
        $requestArray = ['added_by' => Auth::id(),
                         'items_count' => $itemCount,
                         'total_qty'=> $totalQty,
                         'purchase_invoice_id' =>$purcheId,
                        ] + $request->all();

        $row =  BuyReceive::create($requestArray);
        // save receive details
        for ($i=0; $i < count($request->item_id); $i++) {
            if (isset($request->qty[$i])) {
                BuyReceiveDetail::create([

                    'receive_id'        => $row->id,
                    'item_id'           => $request->item_id[$i],
                    'qunatity'          => $request->qty[$i],
                    'purchase_unit_id'  => $request->purchase_unit_id[$i],
                ]);
            }
        }// end of save details

        // handel item quantity
        for ($b=0; $b < count($request->item_id); $b++) {
            if (isset($request->qty[$b])) {
                $quantity =StoQuantity::where([['store_id', '=', $request->store_id],['item_id', '=' ,$request->item_id[$b]]])->first();
                    if ($quantity === null) {
                        //insert new row
                        StoQuantity::create([
                            'store_id' => $request->store_id,
                            'item_id'  => $request->item_id[$b],
                            'quantity' => $request->qty[$b],
                        ]);
                    }elseif($quantity != null){
                        // update row
                        $newQty = $quantity->quantity + $request->qty[$b] ;
                        StoQuantity::where("id", $quantity->id)->update(["quantity" => $newQty]);
                    }
            }
        }// end of save qunatity

        // handel items cards
        for ($c=0; $c < count($request->item_id); $c++) {
            if (isset($request->qty[$c])) {
                StoItemCard::create([
                    'purch_id'     => $purcheId,
                    'receive_id'   => $row->id,
                    'store_id'     => $request->store_id,
                    'item_id'      => $request->item_id[$c],
                    'quantity_in'  => $request->qty[$c],
                    'price_in'     => $request->purch_price[$c],
                    'value_in'     => $request->qty[$c] * $request->purch_price[$c],
                    'description'  => 'عملية شراء',
                    'type'         => 'purch',
                ]);
            }
        }



    }// end of handelReceiveItems

    protected function createCheck($transaction,$request ,$blong ,$beneficiary,$type,$amount){

        FinCheck::create([
            'transaction_id'  => $transaction ,
            'bank_id'         => $request->bank_id,
            'belong_to'       => $blong ,
            'beneficiary'     => $beneficiary ,
            'release_date'    => $request->created_date ,
            'due_date'        => $request->due_date,
            'check_number'    => $request->document_code ,
            'amount'          => $amount,
            'type'            => $type,
            'status'          => 0,
            'notes'           => $request->notes
        ]);
    }// end of create check


} // end of class

?>
