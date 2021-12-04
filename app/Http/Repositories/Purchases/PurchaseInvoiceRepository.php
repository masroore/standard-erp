<?php
namespace App\Http\Repositories\Purchases;
use App\Models\Supplier;
use App\Models\Purchase\BuyPurchaseInvoice;
use App\Http\Interfaces\Purchases\PurchaseInvoiceInterface;
use App\Models\Purchase\BuyPurchaseInvoiceDetail;
use App\Models\Settings\Tax;
use App\Models\Store\StoItem;
use App\Models\Store\StoStore;
use App\Models\Store\StoUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
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
        $rows      = $this->model::get();
       // dd('welcom');
        return view('backend.purchases.invoices.index', compact('rows','suppliers'));
    }//end of index

    public function show($id){
        $row =  $this->model::where('id', $id)->with('supplier','store','items')->first();

      ///  dd( $row);
        return view('backend.purchases.invoices.show', compact('row'));
    }//end of show

    public function create(){
        $suppliers = Supplier::get();
        $taxes     = Tax::get();
        $stores    = StoStore::get();
        $units     = StoUnit::get();
        $routeName = 'purchases';
        return view('backend.purchases.invoices.create', compact('suppliers','taxes','routeName','stores','units'));
    }//e nd of create

    public function search($value,$id){
        $StoItem =  StoItem::where(function ($query) use ($value){
                         $query->where('title_en', 'LIKE', '%'.$value.'%')
                             ->orWhere('title_ar', 'LIKE', '%'.$value.'%')
                             ->orWhere('code', 'LIKE', '%'.$value.'%');
                     })->get();

     return view('backend.purchases.invoices.search', compact('StoItem','id'));


     }// end of search

    public function edit($id){

        $row =   $this->model::FindOrFail($id);
        return view('backend.purchases.invoices.edit', compact('row'));
    }
    public function store($request){

      //dd( $request->all());

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
            $paid = 1;
        }else{
            $paid = 0;
        }

        if($request->document){
            $document = $request->document;
        }else{
            $document = "file to upload";
        }

        $monyId = 31;
        $requestArray = ['added_by' => Auth::id(),'money_id'=> $monyId , 'items_count' => $itemCount,
        'total_qty'=> $totalQty,'order_tax_rate'=>$taxRate,'order_tax'=>$orderTax,
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

        // handel journal details

        // handel payments

        // handel item quantity



 
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


} // end of class

?>
