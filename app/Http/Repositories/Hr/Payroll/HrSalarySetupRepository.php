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
            'employee_id' => 'required|numeric|exists:hr_employees,id|unique:hr_salary_setups,employee_id',
            'gross_salary' => 'required|numeric',
       ]);

            $requestArray = [
                'addition' => json_encode($request->addition),
                'deduction' => json_encode($request->deduction),
            ]+$request->all();
            // dd($requestArray);
            $this->salarSetupModel::create($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم الإنشاء  بنجاح', 'عمل رائع');
        }else{
            alert()->success(' Created Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.salarySetups.index');


    }// end of store
    public function edit($id){
        $row =  $this->salarSetupModel::join('hr_employees', 'hr_employees.id', '=', 'hr_salary_setups.employee_id')
        ->select('hr_salary_setups.*','hr_employees.name as employee_name')
        ->FindOrFail($id);
        $employees =  HrEmployee::get();
        $salaryType =  HrSalaryType::get();
        $routeName = 'salarySetups';
        return view('backend.hrm.payroll.salarySetups.edit',compact('routeName','row','employees','salaryType'));

     }//end of index


    public function update($request,$id){

        $request->validate([
            'employee_id' => 'required|numeric|exists:hr_employees,id|unique:hr_salary_setups,employee_id,'.$id,
            'gross_salary' => 'required|numeric',
       ]);

       $salarSetupModel = $this->salarSetupModel::FindOrFail($id);
       $requestArray = [
            'addition' => json_encode($request->addition),
            'deduction' => json_encode($request->deduction),
        ]+$request->all();

       $salarSetupModel->update($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم التعديل   بنجاح', 'عمل رائع');
        }else{
            alert()->success(' updated Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.salarySetups.index');


    }// end of update

    public function destroy($id){

    $this->salarSetupModel::FindOrFail($id)->delete();

        if( config('app.locale') == 'ar'){
            alert()->success('تم  الحذف  بنجاح', 'عمل رائع');
        }else{
            alert()->success('Deleted Successfully', 'Good Work');
        }


         return redirect()->route('dashboard.salarySetups.index');
    }// end of destroy

} // end of class

?>
