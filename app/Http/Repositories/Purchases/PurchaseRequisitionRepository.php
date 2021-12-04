<?php
namespace App\Http\Repositories\Purchases;
use App\Models\Supplier;
use App\Models\Purchase\BuyPurchaseRequisition;
use App\Http\Interfaces\Purchases\PurchaseRequisitionInterface;
use App\Models\Purchase\BuyPurchaseRequisitionItem;
use App\Models\Purchase\BuySupplierQuotation;
use App\Models\Purchase\BuySupplierQuotationDetail;
use App\Models\Settings\Tax;
use App\Models\Store\StoItem;
use App\Models\Store\StoStore;
use App\Models\Store\StoUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Image;
class PurchaseRequisitionRepository  implements PurchaseRequisitionInterface
{
    private $model;

    public function __construct(BuyPurchaseRequisition $model)
    {
        $this->model = $model;
    }// end of construct

    public function index(){
        $suppliers = Supplier::select('id','contact_person', 'company_name')->get();
        $rows      = $this->model::get();
       // dd('welcom');
        return view('backend.purchases.requisitions.index', compact('rows','suppliers'));
    }//end of index

    public function show($id){
        $row =  $this->model::where('id', $id)->with('items','user')->first();

        return view('backend.purchases.requisitions.show', compact('row'));
    }//end of show

    public function create(){
        $units     = StoUnit::get();
        $suppliers = Supplier::get();
        $routeName = 'purchase-requisitions';
        return view('backend.purchases.requisitions.create', compact('routeName','units','suppliers'));
    }//e nd of create

    public function search($value,$id){
        $StoItem =  StoItem::where(function ($query) use ($value){
                         $query->where('title_en', 'LIKE', '%'.$value.'%')
                             ->orWhere('title_ar', 'LIKE', '%'.$value.'%')
                             ->orWhere('code', 'LIKE', '%'.$value.'%');
                     })->get();

     return view('backend.purchases.requisitions.search', compact('StoItem','id'));


    }// end of search

    public function edit($id){
        $units     = StoUnit::get();
        $routeName = 'purchase-requisitions';
        $suppliers = Supplier::get();
        $row =  $this->model::where('id', $id)->with('items')->first();
        //dd($row);
        return view('backend.purchases.requisitions.edit', compact('routeName','units','row','suppliers'));
    }// end of edit

    public function store($request){

      //dd( $request->all());
        //dd(count($request->supplier_id));
        $request->validate([
            'reference_no'    => 'required',
            'requested_by'    => 'required',
            'date'            => 'required',
            'document'        => 'mimes:jpg,jpeg,png,pdf,csv,xls,xlsx' ,
        ]);

        $totalQty         = array_sum($request->qty);
        $itemCount        = count($request->item_id);    ;

        if($request->document){
            $fileName = time().'.'.$request->document->extension();
            $request->document->move(public_path('uploads/purchases/requisitions'), $fileName);
            $document =  $fileName ;
        }else{
            $document = "Error When Upload File to upload";
        }

        //save new purchese request
        $requestArray = ['added_by' => Auth::id(), 'item_counts' => $itemCount,'total_qty'=> $totalQty,'document'=> $document] + $request->all();

        $row =  $this->model->create($requestArray);

        // save purchese request details
        for ($i=0; $i < count($request->item_id); $i++) {
            if (isset($request->qty[$i])) {
                BuyPurchaseRequisitionItem::create([
                    'request_id'        => $row->id,
                    'item_id'           => $request->item_id[$i],
                    'qunatity'          => $request->qty[$i],
                    'purchase_unit_id'  => $request->purchase_unit_id[$i],
                    'description'       => 'description items',
                ]);
            }
        }// end of save details

        //save new supplier quotation
        if($request->supplier_id){

            for ($i=0; $i < count($request->supplier_id); $i++) {

                $quota =  BuySupplierQuotation::create([
                    'purchase_request_id'   => $row->id,
                    'supplier_id'           => $request->supplier_id[$i],
                    'added_by'              => Auth::id(),
                    'total_qty'             => $totalQty,
                    'item_counts'           => $itemCount,
                    'date'                  => $request->date ,
                ]);

                for ($b=0; $b < count($request->item_id); $b++) {
                    if (isset($request->qty[$b])) {
                        BuySupplierQuotationDetail::create([
                            'buy_quotation_id'  => $quota->id,
                            'item_id'           => $request->item_id[$b],
                            'qunatity'          => $request->qty[$b],
                            'purchase_unit_id'  => $request->purchase_unit_id[$b],

                        ]);
                    }
                }// end of save quotation items

            }//end of save quotation

        }// end of request supplier id


        //dd('check');

        if( config('app.locale') == 'ar'){ alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Created Successfully', 'Good Work'); }
        return redirect()->route('dashboard.purchase-requisitions.index');


    }// end of store

    public function update($request,$id){

       //dd( $request->all());

        $row =   $this->model::FindOrFail($id);
        $request->validate([
            'reference_no'    => 'required',
            'requested_by'    => 'required',
            'date'            => 'required',
            'document'        => 'mimes:jpg,jpeg,png,pdf,csv,xls,xlsx' ,
        ]);

        $totalQty         = array_sum($request->qty);
        $itemCount        = count($request->item_id);

        if($request->document){
            $fileName = time().'.'.$request->document->extension();
            $request->document->move(public_path('uploads/purchases/requisitions'), $fileName);
            $document =  $fileName ;
        }else{
            $document =  $row->document;
        }

        $requestArray = ['item_counts' => $itemCount, 'total_qty'=> $totalQty,'document'=> $document] + $request->all();
        $row->update($requestArray);

        //delete old item
        FacadesDB::table('buy_purchase_requisition_items')->where('request_id', '=', $id)->delete();
        // save details
        for ($i=0; $i < count($request->item_id); $i++) {
            if (isset($request->qty[$i])) {
                BuyPurchaseRequisitionItem::create([
                    'request_id'        => $row->id,
                    'item_id'           => $request->item_id[$i],
                    'qunatity'          => $request->qty[$i],
                    'purchase_unit_id'  => $request->purchase_unit_id[$i],
                    'description'       => 'description items',
                ]);
            }
        }


        if( config('app.locale') == 'ar'){ alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Created Successfully', 'Good Work'); }
        return redirect()->route('dashboard.purchase-requisitions.index');
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


    // start offer request

    public function offerPriceRequest($id){
        $rows =  BuySupplierQuotation::where('purchase_request_id', $id)->with('user','purchRequest','supplier')->get();

        return view('backend.purchases.requisitions.supplierQuotations.index', compact('rows','id'));
    }//end of offer Price Request

    public function showOfferPriceRequest($id){
        $row =  BuySupplierQuotation::where('id', $id)->with('items','user','purchRequest','supplier')->first();
        return view('backend.purchases.requisitions.supplierQuotations.show', compact('row','id'));
    }// end of showOfferPriceRequest

    public function replyOfferPriceRequest($id){

    }// end of replyOfferPriceRequest


} // end of class

?>
