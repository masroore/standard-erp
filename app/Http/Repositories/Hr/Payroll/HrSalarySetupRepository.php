<?php
namespace App\Http\Repositories\Hr\Payroll;

use App\Http\Interfaces\Hr\Payroll\HrSalarySetupInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Hr\HrEmployee;
use App\Models\Hr\Payroll\HrSalarySetup;
use App\Models\Hr\Payroll\HrSalaryType;
use Illuminate\Support\Facades\Auth;
use Image;


class HrSalarySetupRepository implements HrSalarySetupInterface
{


    private $salarSetupModel;

    public function __construct(HrSalarySetup $SalarySetup)
    {
        $this->salarSetupModel = $SalarySetup;

    }

    public function index(){
       $rows =  $this->salarSetupModel::join('hr_employees', 'hr_employees.id', '=', 'hr_salary_setups.employee_id')
       ->select('hr_salary_setups.*','hr_employees.name as employee_name')
       ->get();
       $employees =  HrEmployee::get();
       $salaryType =  HrSalaryType::get();
       $routeName = 'salarySetups';
       return view('backend.hrm.payroll.salarySetups.index',compact('routeName','rows','employees','salaryType'));

    }//end of index




    public function store($request){
        $request->validate([
            'employee_id' => 'required|numeric',
            'date' => 'required|date',
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'image' => 'required|mimes:jpeg,jpg,png,gif,',
       ]);


       if($request->image){

                $image          = $request->image;
                $ext  =  $image->getClientOriginalExtension();
                $imageName     = time().Str::random('10').'.'.$ext;
                $image->move(public_path('uploads/employee/SalarySetups/'),$imageName);
                $imagename= 'uploads/employee/SalarySetups/'.$imageName;
        }


            $requestArray = ['image'=>$imagename]+$request->all();
            $this->salarSetupModel::create($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم الإنشاء  بنجاح', 'عمل رائع');
        }else{
            alert()->success(' Created Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.SalarySetups.index');


    }// end of store

    public function update($request,$id){

        $request->validate([
            'employee_id' => 'required|numeric',
            'date' => 'required|date',
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,',
       ]);

       $salarSetupModel = $this->salarSetupModel::FindOrFail($id);

       if($request->image){

            $image          = $request->image;
            $ext  =  $image->getClientOriginalExtension();
            $imageName     = time().Str::random('10').'.'.$ext;
            $image->move(public_path('uploads/employee/SalarySetups/'),$imageName);
            $imagename= 'uploads/employee/SalarySetups/'.$imageName;
            unlink(public_path($salarSetupModel->image));

        }

        $requestArray = $request->all();
        if(isset($imagename)){
            $requestArray = ['image'=>$imagename]+$request->all();
        }

       $salarSetupModel->update($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم التعديل   بنجاح', 'عمل رائع');
        }else{
            alert()->success(' updated Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.SalarySetups.index');


    }// end of update

    public function destroy($id){

        $salarSetupModel =  $this->salarSetupModel::FindOrFail($id);
        $salarSetupModel->delete();
        unlink(public_path($salarSetupModel->image));
        if( config('app.locale') == 'ar'){
            alert()->success('تم  الحذف  بنجاح', 'عمل رائع');
        }else{
            alert()->success('Deleted Successfully', 'Good Work');
        }


         return redirect()->route('dashboard.SalarySetups.index');
    }// end of destroy

} // end of class

?>
