<?php
namespace App\Http\Repositories\Hr\Payroll;

use App\Http\Interfaces\Hr\Payroll\HrSalaryGenerateInterface;
use App\Models\Hr\Payroll\HrSalaryEmployee;
use App\Models\Hr\Payroll\HrSalaryGenerate;
use App\Models\Hr\Payroll\HrSalarySetup;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Image;


class HrSalaryGenerateRepository implements HrSalaryGenerateInterface
{


    private $salaryGenerateModel;

    public function __construct(HrSalaryGenerate $salaryType)
    {
        $this->salaryGenerateModel = $salaryType;

    }

    public function index(){
       $rows =  $this->salaryGenerateModel::join('users', 'users.id', '=', 'hr_salary_generates.user_id')
       ->select('hr_salary_generates.*','users.name')->get();
       $routeName = 'salaryGenerate';
       return view('backend.hrm.payroll.salaryGenerate.index',compact('routeName','rows'));

    }//end of index




    public function store($request)
    {
        // dd($request->salary_name);
        $request->validate([
            'salary_name' => 'required|string|unique:hr_salary_generates,date',
       ]);

        $requestArray = [
           'salary_name' => Carbon::parse($request->salary_name)->format('F Y'),
           'date' => $request->salary_name,
           'user_id' => Auth::user()->id,
        ];


           $generate = $this->salaryGenerateModel::create($requestArray);
            $SalarySetup = HrSalarySetup::get();
            foreach ($SalarySetup as $setup){
                $SalaryEmployee =[
                    'generate_id' => $generate->id,
                    'employee_id' => $setup->employee_id,
                    'total_salary' =>  $setup->gross_salary,
                ];

                HrSalaryEmployee::create($SalaryEmployee);

            }


        if( config('app.locale') == 'ar'){
            alert()->success('تم الإنشاء  بنجاح', 'عمل رائع');
        }else{
            alert()->success(' Created Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.salaryGenerate.index');


    }// end of store

    public function update($request,$id){


    }// end of update

    public function destroy($id){

         $this->salaryGenerateModel::FindOrFail($id)->delete();
        if( config('app.locale') == 'ar'){
            alert()->success('تم  الحذف  بنجاح', 'عمل رائع');
        }else{
            alert()->success('Deleted Successfully', 'Good Work');
        }


         return redirect()->route('dashboard.salaryGenerate.index');
    }// end of destroy

} // end of class

?>
