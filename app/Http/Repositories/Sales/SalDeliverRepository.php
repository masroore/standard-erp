<?php
namespace App\Http\Repositories\Sales;
use App\Models\Supplier;
use App\Http\Interfaces\Sales\SalDeliverInterface;
use App\Models\Customer;
use App\Models\Purchase\BuyOperation;
use App\Models\Purchase\BuyReceive;
use App\Models\Purchase\BuyReceiveDetail;
use App\Models\Sales\SalDeliver;
use App\Models\Sales\SalDeliverDetail;
use App\Models\Store\StoItem;
use App\Models\Store\StoQuantity;
use App\Models\Store\StoStore;
use App\Models\Store\StoUnit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Image;
class SalDeliverRepository  implements SalDeliverInterface
{
    private $model;

    public function __construct(SalDeliver $model)
    {
        $this->model = $model;
    }// end of construct

    public function index(){
        $customers = Customer::select('id','name', 'company_name')->get();
        $rows      = $this->model::with('user','store','customer')->get();
        return view('backend.sales.delivers.index', compact('rows','customers'));
    }//end of index

    public function show($id){
        $row =  $this->model::where('id', $id)->with('items','user','store','customer')->first();
        return view('backend.sales.delivers.show', compact('row'));
    }//end of show

    public function create($request){
        if($request->operration_id){
            $operation = $request->operration_id ;
        }else{
            $operation = null;
        }
        $units     = StoUnit::all('id','unit_name');
        $stores    = StoStore::select('id','title_ar')->where('is_active',1)->get();
        $customers = Customer::all(['id','name','company_name']);
        $routeName = 'delivers';
        return view('backend.sales.delivers.create', compact('routeName','units','customers','stores','operation'));
    }//e nd of create

    public function search($value,$id){
        $stoItem =  StoItem::where(function ($query) use ($value){
                         $query->where('title_en', 'LIKE', '%'.$value.'%')
                             ->orWhere('title_ar', 'LIKE', '%'.$value.'%')
                             ->orWhere('code', 'LIKE', '%'.$value.'%');
                     })->with('purchUnit')->get();
        return view('backend.sales.delivers.search', compact('stoItem','id'));

    }// end of search

    public function edit($id){
        $units     = StoUnit::all('id','unit_name');
        $routeName = 'delivers';
        $customers = Customer::all(['id','name','company_name']);
        $stores    = StoStore::select('id','title_ar','title_en')->where('is_active',1)->get();
        $row       =  $this->model::where('id', $id)->with('items')->first();
        //dd($row);
        return view('backend.sales.delivers.edit', compact('routeName','units','row','customers','stores'));
    }// end of edit

    public function store($request){

        //dd( $request->all());
        $request->validate([
            'reference_no'    => 'required',
            'store_id'        => 'required',
            'customer_id'     => 'required',
            'date'            => 'required',
            'document'        => 'mimes:jpg,jpeg,png,pdf,csv,xls,xlsx' ,
        ]);

        $totalQty         = array_sum($request->qty);
        $itemCount        = count($request->item_id);    ;

        if($request->document){
            $fileName = time().'.'.$request->document->extension();
            $request->document->move(public_path('uploads/sales/delivers'), $fileName);
            $document =  $fileName ;
        }else{
            $document = "";
        }

        //save new receive
        $requestArray = ['added_by' => Auth::id(),
                        'items_count' => $itemCount,
                        'total_qty'=> $totalQty,
                        'document'=> $document] + $request->all();

        $row =  $this->model->create($requestArray);

        // save receive details
        for ($i=0; $i < count($request->item_id); $i++) {
            if (isset($request->qty[$i])) {
                SalDeliverDetail::create([
                    'deliver_id'        => $row->id,
                    'item_id'           => $request->item_id[$i],
                    'qunatity'          => $request->qty[$i],
                    'unit_id'           => $request->unit_id[$i],
                ]);
            }
        }// end of save details

        //decrees qunatity
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

        if($request->opration_id != null){
            BuyOperation::where("id", $request->opration_id)->update(["is_created_receive" => 1]);
        }

        if( config('app.locale') == 'ar'){ alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Created Successfully', 'Good Work'); }
        return redirect()->route('dashboard.delivers.index');


    }// end of store

    public function update($request,$id){

       //dd( $request->all());

        $row =   $this->model::FindOrFail($id);
        $request->validate([
            'reference_no'    => 'required',
            'store_id'        => 'required',
            'customer_id'     => 'required',
            'date'            => 'required',
            'document'        => 'mimes:jpg,jpeg,png,pdf,csv,xls,xlsx' ,
        ]);

        $totalQty         = array_sum($request->qty);
        $itemCount        = count($request->item_id);

        if($request->document){
            $fileName = time().'.'.$request->document->extension();
            $request->document->move(public_path('uploads/sales/delivers'), $fileName);
            $document =  $fileName ;
        }else{
            $document =  $row->document;
        }

        $requestArray = ['items_count' => $itemCount, 'total_qty'=> $totalQty,'document'=> $document] + $request->all();
        $row->update($requestArray);


        for ($i=0; $i < count($request->item_id); $i++) {
            if (isset($request->qty[$i])) {
                $item =SalDeliverDetail::where([['deliver_id', '=', $row->id],['item_id', '=' ,$request->item_id[$i]]])->first();
                    if ($item === null) {
                        //insert new row
                        SalDeliverDetail::create([
                            'deliver_id'        => $row->id,
                            'item_id'           => $request->item_id[$i],
                            'qunatity'          => $request->qty[$i],
                            'unit_id'           => $request->unit_id[$i],
                        ]);
                    }elseif($item != null){
                        // update row
                        SalDeliverDetail::where("id", $item->id)->update([
                           "qunatity"         => $request->qty[$i],
                           "unit_id"          => $request->unit_id[$i],
                        ]);
                    }
            }
        }// end of update items

        if( config('app.locale') == 'ar'){ alert()->success('تم تعديل السجلات بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Updated Successfully', 'Good Work'); }
        return redirect()->route('dashboard.delivers.index');
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
