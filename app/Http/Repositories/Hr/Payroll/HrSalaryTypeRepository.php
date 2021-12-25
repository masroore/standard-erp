<?php
namespace App\Http\Repositories\Hr\Payroll;

use App\Http\Interfaces\Hr\Payroll\HrSalaryTypeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Hr\Payroll\HrSalaryType;
use Illuminate\Support\Facades\Auth;
use Image;


class HrsalaryTypeRepository implements HrSalaryTypeInterface
{


    private $salarTypeModel;

    public function __construct(HrsalaryType $salarTypeModel)
    // public function __construct(HrSalaryType $salaryType)
    {
        $this->salarTypeModel = $salarTypeModel;

    }

    public function index(){
       $rows =  $this->salarTypeModel::get();
       $routeName = 'salaryTypes';
       return view('backend.hrm.payroll.salaryTypes.index',compact('routeName','rows'));

    }//end of index




    public function store($request){
        $request->validate([
            'benefits' => 'required|string|unique:hr_salary_types,benefits',
            'type' => 'required|string',
       ]);
        $requestArray = [
           'benefits' => str_replace(" ","",ucwords($request->benefits)),
        ]+$request->all();


            $this->salarTypeModel::create($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم الإنشاء  بنجاح', 'عمل رائع');
        }else{
            alert()->success(' Created Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.salaryTypes.index');


    }// end of store

    public function update($request,$id){

        $request->validate([
            'benefits' => 'required|string|unique:hr_salary_types,benefits,'.$id,
            'type' => 'required|string',
       ]);

       $salarTypeModel = $this->salarTypeModel::FindOrFail($id);
       $requestArray = [
        'benefits' => str_replace(" ","",ucwords($request->benefits)),
        ]+$request->all();
       $salarTypeModel->update($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم التعديل   بنجاح', 'عمل رائع');
        }else{
            alert()->success(' updated Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.salaryTypes.index');


    }// end of update

    public function destroy($id){

        $this->salarTypeModel::FindOrFail($id)->delete();

        if( config('app.locale') == 'ar'){
            alert()->success('تم  الحذف  بنجاح', 'عمل رائع');
        }else{
            alert()->success('Deleted Successfully', 'Good Work');
        }


         return redirect()->route('dashboard.salaryTypes.index');
    }// end of destroy

} // end of class

?>
