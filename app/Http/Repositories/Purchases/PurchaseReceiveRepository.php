<?php
namespace App\Http\Repositories\Purchases;
use App\Models\Supplier;
use App\Models\Purchase\BuyPurchaseRequisition;
use App\Http\Interfaces\Purchases\PurchaseReceiveInterface;
use App\Models\Purchase\BuyOperation;
use App\Models\Purchase\BuyPurchaseRequisitionItem;
use App\Models\Purchase\BuyReceive;
use App\Models\Purchase\BuyReceiveDetail;
use App\Models\Purchase\BuySupplierQuotation;
use App\Models\Purchase\BuySupplierQuotationDetail;
use App\Models\Store\StoItem;
use App\Models\Store\StoQuantity;
use App\Models\Store\StoStore;
use App\Models\Store\StoUnit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Image;
class PurchaseReceiveRepository  implements PurchaseReceiveInterface
{
    private $model;

    public function __construct(BuyReceive $model)
    {
        $this->model = $model;
    }// end of construct

    public function index(){
        $suppliers = Supplier::select('id','contact_person', 'company_name')->get();
        $rows      = $this->model::with('user','store','supplier')->get();
        return view('backend.purchases.receives.index', compact('rows','suppliers'));
    }//end of index

    public function show($id){
        $row =  $this->model::where('id', $id)->with('items','user','store','supplier')->first();
        return view('backend.purchases.receives.show', compact('row'));
    }//end of show

    public function create($request){
        if($request->operration_id){
            $operation = $request->operration_id ;
        }else{
            $operation = null;
        }
        $units     = StoUnit::all('id','unit_name');
        $stores    = StoStore::select('id','title_ar')->where('is_active',1)->get();
        $suppliers = Supplier::all(['id','contact_person','company_name']);
        $routeName = 'receives';
        return view('backend.purchases.receives.create', compact('routeName','units','suppliers','stores','operation'));
    }//e nd of create

    public function search($value,$id){
        $stoItem =  StoItem::where(function ($query) use ($value){
                         $query->where('title_en', 'LIKE', '%'.$value.'%')
                             ->orWhere('title_ar', 'LIKE', '%'.$value.'%')
                             ->orWhere('code', 'LIKE', '%'.$value.'%');
                     })->with('purchUnit')->get();
        return view('backend.purchases.receives.search', compact('stoItem','id'));

    }// end of search

    public function edit($id){
        $units     = StoUnit::all('id','unit_name');
        $routeName = 'receives';
        $suppliers = Supplier::all(['id','contact_person','company_name']);
        $stores    = StoStore::select('id','title_ar')->where('is_active',1)->get();
        $row       =  $this->model::where('id', $id)->with('items')->first();
        //dd($row);
        return view('backend.purchases.receives.edit', compact('routeName','units','row','suppliers','stores'));
    }// end of edit

    public function store($request){

        //dd( $request->all());
        $request->validate([
            'reference_no'    => 'required',
            'store_id'        => 'required',
            'supplier_id'     => 'required',
            'date'            => 'required',
            'document'        => 'mimes:jpg,jpeg,png,pdf,csv,xls,xlsx' ,
        ]);

        $totalQty         = array_sum($request->qty);
        $itemCount        = count($request->item_id);    ;

        if($request->document){
            $fileName = time().'.'.$request->document->extension();
            $request->document->move(public_path('uploads/purchases/receives'), $fileName);
            $document =  $fileName ;
        }else{
            $document = "";
        }

        //save new receive
        $requestArray = ['added_by' => Auth::id(), 'items_count' => $itemCount,'total_qty'=> $totalQty,'document'=> $document] + $request->all();

        $row =  $this->model->create($requestArray);

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

        //increes qunatity
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

        if($request->opration_id != null){
            BuyOperation::where("id", $request->opration_id)->update(["is_created_receive" => 1]);
        }
        if( config('app.locale') == 'ar'){ alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Created Successfully', 'Good Work'); }
        return redirect()->route('dashboard.receives.index');


    }// end of store

    public function update($request,$id){

       //dd( $request->all());

        $row =   $this->model::FindOrFail($id);
        $request->validate([
            'reference_no'    => 'required',
            'store_id'        => 'required',
            'supplier_id'     => 'required',
            'date'            => 'required',
            'document'        => 'mimes:jpg,jpeg,png,pdf,csv,xls,xlsx' ,
        ]);

        $totalQty         = array_sum($request->qty);
        $itemCount        = count($request->item_id);

        if($request->document){
            $fileName = time().'.'.$request->document->extension();
            $request->document->move(public_path('uploads/purchases/receives'), $fileName);
            $document =  $fileName ;
        }else{
            $document =  $row->document;
        }

        $requestArray = ['items_count' => $itemCount, 'total_qty'=> $totalQty,'document'=> $document] + $request->all();
        $row->update($requestArray);


        for ($i=0; $i < count($request->item_id); $i++) {
            if (isset($request->qty[$i])) {
                $item =BuyReceiveDetail::where([['receive_id', '=', $row->id],['item_id', '=' ,$request->item_id[$i]]])->first();
                    if ($item === null) {
                        //insert new row
                        BuyReceiveDetail::create([
                            'receive_id'        => $row->id,
                            'item_id'           => $request->item_id[$i],
                            'qunatity'          => $request->qty[$i],
                            'purchase_unit_id'  => $request->purchase_unit_id[$i],
                        ]);
                    }elseif($item != null){
                        // update row
                       BuyReceiveDetail::where("id", $item->id)->update([
                           "quantity"         => $request->qty[$i],
                           "purchase_unit_id" => $request->purchase_unit_id[$i],
                        ]);
                    }
            }
        }// end of update items

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

} // end of class

?>
