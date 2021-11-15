<?php
namespace App\Http\Repositories;
use App\Models\ParentCompany;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Interfaces\ParentCompanyInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;
class ParentCompanyRepository  implements ParentCompanyInterface
{
    use ApiDesignTrait;

     private $parentCompanyModel;

    public function __construct(ParentCompany $parentCompany)
    {
        $this->parentCompanyModel = $parentCompany;
    }

    public function index(){
       $rows =  ParentCompany::select('id' , 'name', 'code')->get();
       $routeName = 'customers';
       return view('backend.parentCompany.index',compact('routeName','rows'));
    }//end of index


    public function store($request){
    //    dd('welcome');

       $request->validate([
        'name' => 'required|string|unique:parent_companies,name',
        'code' => 'required|string|unique:parent_companies,code|max:15',

        ]);


        $requestArray =$request->all();

    $this->parentCompanyModel->create($requestArray);
        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء الشركه جديد بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Company Created Successfully', 'Good Work');
        }
        return redirect()->back();


    }// end of store

    public function update($request,$id){

        $request->validate([
            'name' => 'required|string|unique:parent_companies,name,'. $id,
            'code' => 'required|string|max:15|unique:parent_companies,code,'. $id,

        ]);

            $requestArray =$request->all();
            $parentCompany =   $this->parentCompanyModel::FindOrFail($id);

            $parentCompany->update($requestArray);

            if( config('app.locale') == 'ar'){
                alert()->success('تم تعديل الشركه  بنجاح', 'عمل رائع');
            }else{
                alert()->success('The Company Updated Successfully', 'Good Work');
            }
            return redirect()->back();


    }// end of update

    public function destroy($id){
        ParentCompany::FindOrFail($id)->delete();
        return $this->ApiResponse(200, 'Deleted Successfully', null);
    }// end of destroy


} // end of class

?>
