<?php
namespace App\Http\Repositories\Hr;

use App\Http\Interfaces\Hr\HrMedicalInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Hr\HrEmployeeMedical;
use App\Models\Hr\HrEmployee;
use Illuminate\Support\Facades\Auth;
use Image;


class HrMedicalRepository implements HrMedicalInterface
{


    private $medicalModel;

    public function __construct(HrEmployeeMedical $medical)
    {
        $this->medicalModel = $medical;

    }

    public function index(){
       $rows =  $this->medicalModel::join('hr_employees', 'hr_employees.id', '=', 'hr_employee_medicals.employee_id')
       ->select('hr_employee_medicals.*','hr_employees.name as employee_name')
       ->get();
       $employees =  HrEmployee::get();
       $routeName = 'medicals';
       return view('backend.hrm.medicals.index',compact('routeName','rows','employees'));

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
                $image->move(public_path('uploads/employee/medicals/'),$imageName);
                $imagename= 'uploads/employee/medicals/'.$imageName;
        }


            $requestArray = ['image'=>$imagename]+$request->all();
            $this->medicalModel::create($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم الإنشاء  بنجاح', 'عمل رائع');
        }else{
            alert()->success(' Created Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.medicals.index');


    }// end of store

    public function update($request,$id){

        $request->validate([
            'employee_id' => 'required|numeric',
            'date' => 'required|date',
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,',
       ]);

       $medicalModel = $this->medicalModel::FindOrFail($id);

       if($request->image){

            $image          = $request->image;
            $ext  =  $image->getClientOriginalExtension();
            $imageName     = time().Str::random('10').'.'.$ext;
            $image->move(public_path('uploads/employee/medicals/'),$imageName);
            $imagename= 'uploads/employee/medicals/'.$imageName;
            unlink(public_path($medicalModel->image));

        }

        $requestArray = $request->all();
        if(isset($imagename)){
            $requestArray = ['image'=>$imagename]+$request->all();
        }

       $medicalModel->update($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم التعديل   بنجاح', 'عمل رائع');
        }else{
            alert()->success(' updated Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.medicals.index');


    }// end of update

    public function destroy($id){

        $medicalModel =  $this->medicalModel::FindOrFail($id);
        $medicalModel->delete();
        unlink(public_path($medicalModel->image));
        if( config('app.locale') == 'ar'){
            alert()->success('تم  الحذف  بنجاح', 'عمل رائع');
        }else{
            alert()->success('Deleted Successfully', 'Good Work');
        }


         return redirect()->route('dashboard.medicals.index');
    }// end of destroy

} // end of class

?>
