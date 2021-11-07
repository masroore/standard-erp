<?php
namespace App\Http\Repositories\Purchases;
use App\Models\Supplier;
use App\Http\Interfaces\Purchases\SupplierInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;
use Image;
class SupplierRepository  implements SupplierInterface
{
    private $supplierModel;

    public function __construct(Supplier $supplier)
    {
        $this->supplierModel = $supplier;
    }// end of construct

    public function index(){
        $suppliers =  $this->supplierModel::get();
        return view('backend.purchases.suppliers.index', compact('suppliers'));
    }//end of index

    public function show($id){
        $row =  $this->supplierModel::where('id', $id)->get();
        return view('backend.purchases.suppliers.show', compact('row'));
    }//end of show

    public function create(){
        $countries = DB::table('countries')->get();
        return view('backend.purchases.suppliers.create', compact('countries'));
    }//e nd of create

    public function edit($id){
        $countries = DB::table('countries')->get();
        $row =   $this->supplierModel::FindOrFail($id);
        return view('backend.purchases.suppliers.edit', compact('countries','row'));
    }
    public function store($request){

        $validation = Validator::make($request->all(),[
            'contact_person'  => 'required|string',
            'company_name'    => 'required|string',
            'phone'           => 'required|digits:11',
            'fax'             => 'numeric',
            'email'           => 'required|email|unique:suppliers',
            'address'         => 'required',
            'tax_id'          => 'required|unique:suppliers',
            'tax_file_number' => 'required|unique:suppliers',
       ]);

        if($request->is_active == 1){
            $status = 1;
        }else{
            $status = 0;
        }
        $requestArray =   ['is_active' => $status] +$request->all() ;

        $row =  $this->supplierModel::create($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Created Successfully', 'Good Work');
        }
        return redirect()->route('dashboard.suppliers.index');


    }// end of store

    public function update($request,$id){

        $row =   $this->supplierModel::FindOrFail($id);

            $validation = Validator::make($request->all(),[
                'contact_person'  => 'required|string',
                'company_name'    => 'required|string',
                'phone'           => 'required|digits:11',
                'fax'             => 'numeric',
                'email'           => 'required|email|unique:suppliers,email,'.$id,
                'address'         => 'required',
                'tax_id'          => 'required|unique:suppliers,tax_id,'.$id,
                'tax_file_number' => 'required|unique:suppliers,tax_file_number,'.$id,
            ]);

        if($request->is_active == 1){
            $status = 1;
        }else{
            $status = 0;
        }
        $requestArray =   ['is_active' => $status] +$request->all() ;

        $row->update($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم تعديل السجل  بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Updated Successfully', 'Good Work');
        }
        return redirect()->route('dashboard.suppliers.index');
    }// end of update

    public function destroy($id){
        $this->supplierModel::FindOrFail($id)->delete();

        if( config('app.locale') == 'ar'){
            alert()->success('تم حذف بيانات السجل بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Deleted Successfully', 'Good Work');
        }
        return redirect()->back();

    }// end of destroy


} // end of class

?>
