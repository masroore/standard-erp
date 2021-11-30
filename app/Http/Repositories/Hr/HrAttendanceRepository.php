<?php
namespace App\Http\Repositories\Hr;

use App\Http\Interfaces\Hr\HrAttendanceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Hr\HrAttendance;
use App\Models\Hr\HrEmployee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Image;


class HrAttendanceRepository implements HrAttendanceInterface
{


    private $attendanceModel;

    public function __construct(HrAttendance $attendance)
    {
        $this->attendanceModel = $attendance;

    }

    public function index(){
       $rows =  $this->attendanceModel::join('hr_employees', 'hr_employees.id', '=', 'hr_attendances.employee_id')
       ->join('users', 'users.id', '=', 'hr_attendances.created_by')
       ->select('hr_attendances.*','hr_employees.name as employee_name','users.name as user_name')
       ->get();
       $employees =  HrEmployee::get();
       $users =  User::get();
       $routeName = 'attendances';
       return view('backend.hrm.attendances.index',compact('routeName','rows','employees','users'));

    }//end of index




    public function store($request){
        $request->validate([
            'employee_id' => 'required|numeric',
            'date' => 'required|date',
            'check_in' => 'required|string',
            'check_out' => 'required|string',
            'note' => 'required|string',

       ]);


       $requestArray = $request->all()+['created_by'=> Auth::user()->id,'status'=>'present'];
       $this->attendanceModel::create($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء قسم جديد بنجاح', 'عمل رائع');
        }else{
            alert()->success('User Created Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.attendances.index');


    }// end of store

    public function update($request,$id){

        $request->validate([
            'employee_id' => 'required|numeric',
            'date' => 'required|date',
            'check_in' => 'required|string',
            'check_out' => 'required|string',
            'note' => 'required|string',

       ]);


       $requestArray = $request->all()+['created_by'=> Auth::user()->id,'status'=>'present'];

         $this->attendanceModel::FindOrFail($id)->update($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم تعديل القسم  بنجاح', 'عمل رائع');
        }else{
            alert()->success('attendance updated Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.attendances.index');


    }// end of update

    public function destroy($id){

        $this->attendanceModel::FindOrFail($id)->delete();

        if( config('app.locale') == 'ar'){
            alert()->success('تم  الحذف  بنجاح', 'عمل رائع');
        }else{
            alert()->success('Deleted Successfully', 'Good Work');
        }


         return redirect()->route('dashboard.attendances.index');
    }// end of destroy

    public function search($request)
    {
       $rows = $this->attendanceModel::join('hr_employees', 'hr_employees.id', '=', 'hr_attendances.employee_id')
       ->join('users', 'users.id', '=', 'hr_attendances.created_by')
       ->select('hr_attendances.*','hr_employees.name as employee_name','users.name as user_name')
      ->where(function($query) use ($request) {
                if (!empty($request->employee_id)) {
                    $query->where('employee_id', $request->employee_id);
                }
                if (!empty($request->date)) {
                    $query->where('date', $request->date);
                }
                if (!empty($request->from) && !empty($request->to) && $request->type == 'check_in') {

                    $query->whereBetween('check_in', [$request->from,$request->to]);
                }
                if (!empty($request->from) && !empty($request->to) && $request->type == 'check_out') {
                    $query->whereBetween('check_out', [$request->from,$request->to]);
                }
                if (!empty($request->status)) {
                    $query->where('hr_attendances.status', $request->status);
                }
                if (!empty($request->created_by)) {
                    $query->where('hr_attendances.created_by', $request->created_by);
                }
            })->get();

            $employees =  HrEmployee::get();
            $users =  User::get();
            $routeName = 'attendances';
            return view('backend.hrm.attendances.index',compact('routeName','rows','employees','users'));

    }

} // end of class

?>
