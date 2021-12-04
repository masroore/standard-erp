<?php
namespace App\Http\Repositories\Purchases;
use App\Models\Supplier;
use App\Models\Purchase\BuyPurchaseOrder;
use App\Http\Interfaces\Purchases\PurchaseOrderInterface;
use App\Models\Purchase\BuyPurchaseOrderDetail;
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
class PurchaseOrderRepository  implements PurchaseOrderInterface
{
    private $model;

    public function __construct(BuyPurchaseOrder $model)
    {
        $this->model = $model;
    }// end of construct

    public function index(){
        $suppliers = Supplier::select('id','contact_person', 'company_name')->get();
        $rows      = $this->model::get();
       // dd('welcom');
        return view('backend.purchases.purchaseOrders.index', compact('rows','suppliers'));
    }//end of index

    public function show($id){
        $row =  $this->model::where('id', $id)->with('supplier','items')->first();

        return view('backend.purchases.purchaseOrders.show', compact('row'));
    }//end of show

    public function create(){
        $suppliers = Supplier::get();
        $taxes     = Tax::get();
        $stores    = StoStore::get();
        $units     = StoUnit::get();
        $routeName = 'purchase-orders';
        return view('backend.purchases.purchaseOrders.create', compact('suppliers','taxes','routeName','stores','units'));
    }//e nd of create

    public function search($value,$id){
        $StoItem =  StoItem::where(function ($query) use ($value){
                         $query->where('title_en', 'LIKE', '%'.$value.'%')
                             ->orWhere('title_ar', 'LIKE', '%'.$value.'%')
                             ->orWhere('code', 'LIKE', '%'.$value.'%');
                     })->get();

        return view('backend.purchases.purchaseOrders.search', compact('StoItem','id'));
    }// end of search

    public function edit($id){
        $suppliers = Supplier::get();
        $taxes     = Tax::get();
        $stores    = StoStore::get();
        $units     = StoUnit::get();
        $routeName = 'purchase-orders';
        $row =   $this->model::FindOrFail($id);
        return view('backend.purchases.purchaseOrders.edit', compact('row','suppliers','taxes','stores','units','routeName'));
    }
    public function store($request){

      //dd( $request->all());

        $request->validate([
            'reference_no'    => 'required',
            'date'            => 'required',
            'document'        => 'mimes:jpg,jpeg,png,pdf,csv,xls,xlsx' ,
        ]);

        $totalQty         = array_sum($request->qty);
        $itemCount        = count($request->item_id);
        $taxRate          = $request->invoice_tax;
        $taxAount         = $request->invoice_tax_amount;
        $discountAmount   = $request->invoice_discount_amount;

        if($request->document){
            $fileName = time().'.'.$request->document->extension();
            $request->document->move(public_path('uploads/purchases/po'), $fileName);
            $document =  $fileName ;
        }else{
            $document = "";
        }

        //save new purchese order
        $requestArray = ['added_by' => Auth::id(), 'items_count' => $itemCount,'tax_rate' => $taxRate  , 'tax_amount'=>$taxAount ,
        'total_qty'=> $totalQty,'document'=> $document, 'total_discount'=>$discountAmount, 'total_cost' => $request->grand_total] + $request->all();

        $row =  $this->model->create($requestArray);

        // save purchese order details
        for ($i=0; $i < count($request->item_id); $i++) {
            if (isset($request->qty[$i]) && isset($request->purch_price[$i])){
                BuyPurchaseOrderDetail::create([
                    'po_id'             => $row->id,
                    'item_id'           => $request->item_id[$i],
                    'qunatity'          => $request->qty[$i],
                    'purchase_unit_id'  => $request->purchase_unit_id[$i],
                    'unit_price'        => $request->purch_price[$i],
                    'total'             => $request->total_line_price[$i],
                ]);
            }
        }// end of save details

        if( config('app.locale') == 'ar'){ alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Created Successfully', 'Good Work'); }
        return redirect()->route('dashboard.purchase-orders.index');

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
