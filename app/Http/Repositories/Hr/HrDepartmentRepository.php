<?php
namespace App\Http\Repositories\Hr;
use App\Models\Hr\HrDepartment;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Interfaces\Hr\HrDepartmentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class HrDepartmentRepository implements HrDepartmentInterface
{
    use ApiDesignTrait;

    private $departmentModel;

    public function __construct(HrDepartment $department)
    {
        $this->departmentModel = $department;

    }

    public function index(){
       $rows =  $this->departmentModel::get();
       $routeName = 'dpartments';
       return view('backend.hrm.departments.index',compact('routeName','rows'));

    }//end of index

    public function getById($id){
        $row =  $this->departmentModel::where('id', $id)->get();
        return $this->ApiResponse(200, 'Done', null,  $row);
    }


    public function store($request){
        $request->validate([
            'name_en' => 'required|string|max:20|unique:hr_departments,name_en',
            'name_ar' => 'required|string|max:20|unique:hr_departments,name_ar',

       ]);


       $this->departmentModel::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en
        ]);

        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء قسم جديد بنجاح', 'عمل رائع');
        }else{
            alert()->success('User Created Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.departments.index');


    }// end of store

    public function update($request,$id){

        $request->validate([
            'name_en' => 'required|string|max:20|unique:hr_departments,name_en,'. $id,
            'name_ar' => 'required|string|max:20|unique:hr_departments,name_ar,'. $id,

       ]);



        $dpartment =   $this->departmentModel::FindOrFail($id);

        $dpartment->name_ar = $request->name_ar ;
        $dpartment->name_en = $request->name_en ;
        $dpartment->save();

        if( config('app.locale') == 'ar'){
            alert()->success('تم تعديل القسم  بنجاح', 'عمل رائع');
        }else{
            alert()->success('Department updated Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.departments.index');


    }// end of update

    public function destroy($id){

        $this->departmentModel::FindOrFail($id)->delete();

        if( config('app.locale') == 'ar'){
            alert()->success('تم  الحذف  بنجاح', 'عمل رائع');
        }else{
            alert()->success('Deleted Successfully', 'Good Work');
        }


         return redirect()->route('dashboard.departments.index');
    }// end of destroy


} // end of class

?>
