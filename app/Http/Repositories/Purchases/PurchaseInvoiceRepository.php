<?php
namespace App\Http\Repositories\Purchases;
use App\Models\Supplier;
use App\Models\Purchase\BuyPurchaseInvoice;
use App\Http\Interfaces\Purchases\PurchaseInvoiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $row =  $this->model::where('id', $id)->get();
        return view('backend.purchases.invoices.show', compact('row'));
    }//end of show

    public function create(){

        return view('backend.purchases.invoices.create');
    }//e nd of create

    public function edit($id){

        $row =   $this->model::FindOrFail($id);
        return view('backend.purchases.invoices.edit', compact('row'));
    }
    public function store($request){

        $validation = Validator::make($request->all(),[

       ]);


        $requestArray =   ['' => $validation] +$request->all() ;

        $row =  $this->model::create($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Created Successfully', 'Good Work');
        }
        return redirect()->route('dashboard.suppliers.index');


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