<?php
namespace App\Http\Repositories\Purchases;
use App\Models\Supplier;
use App\Models\Purchase\BuyOperation;
use App\Http\Interfaces\Purchases\PurchaseOperationInterface;
use App\Models\Purchase\BuyPurchaseRequisitionItem;
use App\Models\Purchase\BuySupplierQuotation;
use App\Models\Purchase\BuySupplierQuotationDetail;
use App\Models\Store\StoItem;
use App\Models\Store\StoUnit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Image;
class PurchaseOperationRepository  implements PurchaseOperationInterface
{
    private $model;

    public function __construct(BuyOperation $model)
    {
        $this->model = $model;
    }// end of construct

    public function index(){

        $rows      = $this->model::get();
        return view('backend.purchases.operations.index', compact('rows'));
    }//end of index

    public function show($id){
        $row =  $this->model::where('id', $id)->with('user','custOrderSuplly')->first();
        return view('backend.purchases.operations.show', compact('row'));
    }//end of show



    public function store($request){
        $request->validate([
            'code'    => 'required',
            'start_at'        => 'required',
        ]);

        $requestArray = ['created_by' => Auth::id()] + $request->all();

        $row =  $this->model->create($requestArray);

        if( config('app.locale') == 'ar'){ alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Created Successfully', 'Good Work'); }
        return redirect()->route('dashboard.purchase-operations.show',$row->id);


    }// end of store

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
        return redirect()->route('dashboard.purchase-operations.index');
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
