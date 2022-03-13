<?php
namespace App\Http\Repositories\Sales;
use App\Models\Supplier;
use App\Models\Purchase\BuyPurchaseOrder;
use App\Http\Interfaces\Sales\SalOrderedSupplyCustomerInterface;
use App\Models\Customer;
use App\Models\Purchase\BuyOperation;
use App\Models\Purchase\BuyPurchaseOrderDetail;
use App\Models\Sales\SalOrderedSupplyCustomer;
use App\Models\Sales\SalOrderedSupplyCustomerDetail;
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
class SalOrderedSupplyCustomerRepository  implements SalOrderedSupplyCustomerInterface
{
    private $model;

    public function __construct(SalOrderedSupplyCustomer $model)
    {
        $this->model = $model;
    }// end of construct

    public function index(){
        $customers = Customer::select('id','name', 'company_name')->get();
        $rows      = $this->model::get();
       // dd('welcom');
        return view('backend.sales.customerOrderSuplly.index', compact('rows','customers'));
    }//end of index

    public function show($id){
        $row =  $this->model::where('id', $id)->with('customer','items')->first();

        return view('backend.sales.customerOrderSuplly.show', compact('row'));
    }//end of show

    public function create($request){

        if($request->operration_id){
            $operation = $request->operration_id ;
        }else{
            $operation = null;
        }
        $customers = Customer::select('id','name', 'company_name')->get();
        $taxes     = Tax::get();
        $stores    = StoStore::select('id','title_ar', 'title_en')->get();
        $units     = StoUnit::select('id','unit_code', 'unit_name','base_unit')->get();
        $routeName = 'customer-order-supply';
        return view('backend.sales.customerOrderSuplly.create', compact('customers','taxes','routeName','stores','units','operation'));
    }//e nd of create

    public function search($value,$id){
        $StoItem =  StoItem::where(function ($query) use ($value){
                         $query->where('title_en', 'LIKE', '%'.$value.'%')
                             ->orWhere('title_ar', 'LIKE', '%'.$value.'%')
                             ->orWhere('code', 'LIKE', '%'.$value.'%');
                     })->get();

        return view('backend.sales.customerOrderSuplly.search', compact('StoItem','id'));
    }// end of search

    public function edit($id){

        $customers = Customer::select('id','name', 'company_name')->get();
        $taxes     = Tax::get();
        $stores    = StoStore::select('id','title_ar', 'title_en')->get();
        $units     = StoUnit::select('id','unit_code', 'unit_name','base_unit')->get();
        $routeName = 'customer-order-supply';
        $row =   $this->model::FindOrFail($id);
        return view('backend.sales.customerOrderSuplly.edit', compact('row','customers','taxes','stores','units','routeName'));
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
        'total_qty'=> $totalQty,'document'=> $document, 'total_discount'=>$discountAmount] + $request->all();

        $row =  $this->model->create($requestArray);

        // save purchese order details
        for ($i=0; $i < count($request->item_id); $i++) {
            if (isset($request->qty[$i]) && isset($request->purch_price[$i])){
                SalOrderedSupplyCustomerDetail::create([
                    'cust_order_suppliy_id' => $row->id,
                    'item_id'               => $request->item_id[$i],
                    'qunatity'              => $request->qty[$i],
                    'unit_id'               => $request->purchase_unit_id[$i],
                    'unit_price'            => $request->purch_price[$i],
                    'total'                 => $request->total_line_price[$i],
                ]);
            }
        }// end of save details

        if($request->opration_id != null){
            BuyOperation::where("id", $request->opration_id)->update(["is_created_cust_po" => 1]);
        }

        if( config('app.locale') == 'ar'){ alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Created Successfully', 'Good Work'); }
        return redirect()->route('dashboard.customer-order-supply.index');

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
