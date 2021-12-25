<?php
namespace App\Http\Repositories\Hr\Payroll;

use App\Http\Interfaces\Hr\Payroll\HrSalaryEmployeeInterface;
use App\Models\Hr\Payroll\HrSalaryEmployee;
use App\Models\Hr\Payroll\HrSalaryGenerate;
use App\Models\Hr\Payroll\HrSalarySetup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Hr\Payroll\HrSalaryType;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Image;


class HrSalaryEmployeeRepository implements HrSalaryEmployeeInterface
{


    private $salarEmployeeModel;

    public function __construct(HrSalaryEmployee $salaryEmployee)
    {
        $this->salarEmployeeModel = $salaryEmployee;

    }

    public function index($generate_id){
       $rows =   $this->salarEmployeeModel::with('users')->join('hr_employees', 'hr_employees.id', '=', 'hr_salary_employees.employee_id')
       ->join('hr_salary_generates', 'hr_salary_generates.id', '=', 'hr_salary_employees.generate_id')
       ->select('hr_salary_employees.*','hr_employees.name','hr_salary_generates.salary_name')
       ->where('generate_id',$generate_id)
       ->get();
       $routeName = 'salaryEmployee';

       return view('backend.hrm.payroll.salaryEmployee.index',compact('routeName','rows'));

    }//end of index




    public function store($request){



    }// end of store

    public function update($request,$id){

        $request->validate([
            'employee_id' => 'required|string|exists:hr_employees,id',
            'total_salary' => 'required|numeric',
            'pay_type' => 'required|numeric',
       ]);


       $salarEmployeeModel = $this->salarEmployeeModel::FindOrFail($id);
       $requestArray = [
            'paid_by' => Auth::user()->id,
            'date' => Carbon::parse()->format('Y-m-d'),
        ]+$request->all();
       $salarEmployeeModel->update($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم التعديل   بنجاح', 'عمل رائع');
        }else{
            alert()->success(' updated Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.salaryEmployee.index');


    }// end of update

    public function invoice($id){
        $row =   $this->salarEmployeeModel::with('users:id,name')
        ->join('hr_employees', 'hr_employees.id', '=', 'hr_salary_employees.employee_id')
        ->join('hr_salary_generates', 'hr_salary_generates.id', '=', 'hr_salary_employees.generate_id')
        ->join('hr_salary_setups', 'hr_salary_setups.employee_id', '=', 'hr_salary_employees.employee_id')
        ->select('hr_salary_employees.*','hr_salary_setups.basic','hr_salary_setups.is_percentage','hr_salary_setups.addition','hr_salary_setups.deduction','hr_employees.name','hr_employees.address','hr_salary_generates.salary_name')
        ->FindOrFail($id);
        $routeName = 'salaryEmployee';
        // dd($rows);

        return view('backend.hrm.payroll.salaryEmployee.invoice',compact('routeName','row'));

     }//end of index

    public function destroy($id){

         $this->salarEmployeeModel::FindOrFail($id)->delete();
        if( config('app.locale') == 'ar'){
            alert()->success('تم  الحذف  بنجاح', 'عمل رائع');
        }else{
            alert()->success('Deleted Successfully', 'Good Work');
        }


         return redirect()->route('dashboard.salaryEmployees.index');
    }// end of destroy

} // end of class

?>
