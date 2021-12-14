<?php
namespace App\Http\Repositories\Hr;

use App\Http\Interfaces\Hr\HrEmployeeFileInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Hr\HrEmployeeFile;
use App\Models\Hr\HrEmployee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Image;


class HrEmployeeFileRepository implements HrEmployeeFileInterface
{


    private $employeeFilesModel;

    public function __construct(HrEmployeeFile $employeeFiles)
    {
        $this->employeeFilesModel = $employeeFiles;

    }

    public function index(){
       $rows =  $this->employeeFilesModel::join('hr_employees', 'hr_employees.id', '=', 'hr_employee_files.employee_id')
       ->select('hr_employee_files.*','hr_employees.name as employee_name')
       ->get();
       $employees =  HrEmployee::get();
       $routeName = 'employeeFiles';
       return view('backend.hrm.employeeFiles.index',compact('routeName','rows','employees'));

    }//end of index




    public function store($request){
        $request->validate([
            'employee_id' => 'required|numeric',
            'title_en'    => 'required|string',
            'title_ar'    => 'required|string',
            'file'        => 'required|mimes:jpeg,jpg,png,gif,doc,pdf,docx,zip',
       ]);

       if($request->file){

                $file          = $request->file;
                $ext  =  $file->getClientOriginalExtension();
                $fileName     = time().Str::random('10').'.'.$ext;
                $file->move(public_path('uploads/employee/files/'),$fileName);
                $filenameEployee= 'uploads/employee/files/'.$fileName;
        }


       $requestArray = ['file'=>$filenameEployee]+$request->all();
       $this->employeeFilesModel::create($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء  بنجاح', 'عمل رائع');
        }else{
            alert()->success(' Created Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.employeeFiles.index');


    }// end of store

    public function update($request,$id){

        $request->validate([
            'employee_id' => 'required|numeric',
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'file' => 'nullable|mimes:jpeg,jpg,png,gif,doc,pdf,docx,zip',
       ]);



       $employeeFilesModel= $this->employeeFilesModel::FindOrFail($id);

       if($request->file){

                $file          = $request->file;
                $ext  =  $file->getClientOriginalExtension();
                $fileName     = time().Str::random('10').'.'.$ext;
                $file->move(public_path('uploads/employee/files/'),$fileName);
                $filenameEployee= 'uploads/employee/files/'.$fileName;
                unlink(public_path($employeeFilesModel->file));

        }

        $requestArray = $request->all();
        if(isset($filenameEployee)){
            $requestArray = ['file'=>$filenameEployee]+$request->all();
        }

        $employeeFilesModel->update($requestArray);



        if( config('app.locale') == 'ar'){
            alert()->success('تم التعديل   بنجاح', 'عمل رائع');
        }else{
            alert()->success('employeeFiles updated Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.employeeFiles.index');


    }// end of update

    public function destroy($id){

     $employeeFilesModel =  $this->employeeFilesModel::FindOrFail($id);
     $employeeFilesModel->delete();
     unlink(public_path($employeeFilesModel->file));


        if( config('app.locale') == 'ar'){
            alert()->success('تم  الحذف  بنجاح', 'عمل رائع');
        }else{
            alert()->success('Deleted Successfully', 'Good Work');
        }


         return redirect()->route('dashboard.employeeFiles.index');
    }// end of destroy

} // end of class

?>
