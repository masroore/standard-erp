<?php
namespace App\Http\Repositories\Hr;

use App\Http\Interfaces\Hr\HrEmployeeInterface;
use App\Models\Hr\Department;
use App\Models\Hr\HrDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Hr\HrEmployee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;


class HrEmployeeRepository implements HrEmployeeInterface
{

    private $employeeModel;

    public function __construct(HrEmployee $employee)
    {
        $this->employeeModel = $employee;
    }

    public function index(){
       $routeName = 'employees';
       $employees =  $this->employeeModel::join('hr_departments', 'hr_departments.id', '=', 'hr_employees.department_id')
       ->select('hr_employees.*','hr_departments.name_en as department_en','hr_departments.name_ar as department_ar')

       ->get();
       return view('backend.hrm.employees.index',compact('routeName','employees'));
    }//end of index

    public function getById($id){
        $row =  $this->employeeModel::where('id', $id)->get();
    }

    public function create()
    {
        $routeName = 'employees';
        $roles = Role::get();
        $departments = HrDepartment::get();

        return view('backend.hrm.employees.create',compact('routeName','roles','departments'));
    }

    public function store($request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'birthday' => 'required|date',
            'password' => 'nullable|min:6',
            'email_user' => 'nullable|string|email',
            'date_of_joining' => 'required|date',
            'department_id' => 'required|numeric',
            'gender' => 'required|string',
       ]);



       ($request->status) ? $status = $request->status : $status = 0;
       ($request->role) ? $role = $request->role : $role = null;

       $fileName = null;
       $filenameEployee= null;
        if($request->photo){

            $img          = $request->photo;
            $fileName     = time().Str::random('10').'.'.$img->getClientOriginalExtension();
            $img          = Image::make($img);

            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save(public_path('uploads/users/photos/'. $fileName));
            $img->save(public_path('uploads/employee/photos/'. $fileName));
            $filenameEployee= 'uploads/employee/photos/'.$fileName;
        }




        if($request->add_user == 1){
            $user=   User::create([
                'name'       => $request->name,
                'phone'      => $request->phone,
                'status'     => $status,
                'photo'      => $fileName,
                'email'      => $request->email_user,
                'password'   => Hash::make($request->password),
                'created_by' => Auth::user()->id,
                'role_id' => $role,
            ]);
            $user->roles()->attach($request->role);
        }


       (isset($user)) ? $user_id = $user->id : $user_id = null;

        $this->employeeModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'photo'      => $filenameEployee,
            'address' => $request->address,
            'birthday' => $request->birthday,
            'date_of_joining' => $request->date_of_joining,
            'department_id' => $request->department_id,
            'gender' => $request->gender,
            'status' => $status,
            'user_id' => $user_id,
        ]);


        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء مستخدم جديد بنجاح', 'عمل رائع');
        }else{
            alert()->success('User Created Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.employees.index');



    }// end of store

    public function edit($id){


        $row = $this->employeeModel->FindOrFail($id);

      //  dd($row);
        if ($row->user_id > 0) {
            $row = $this->employeeModel->join('role_user', 'role_user.user_id', '=', 'hr_employees.user_id')
            ->join('users', 'users.id', '=', 'hr_employees.user_id')
            ->select('hr_employees.*','users.email as email_user','users.role_id')
            ->FindOrFail($id);
        }



        $roles = Role::get();
        $departments = HrDepartment::get();

        return view('backend.hrm.employees.edit',compact('row','roles','departments'));
    }// end of edit
    public function update($request,$id){

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'birthday' => 'required|date',
            'password' => 'nullable|min:6',
            'email_user' => 'nullable|string|email',
            'date_of_joining' => 'required|date',
            'department_id' => 'required|numeric',
            'gender' => 'required|string',
       ]);

       ($request->status) ? $status = $request->status : $status = 0;
       ($request->role) ? $role = $request->role : $role = null;
       $employee =   $this->employeeModel::FindOrFail($id);


        $user_id = $this->updateUser($request,$employee,$role,$status);

       $employee->name = $request->name ;
       $employee->email = $request->email ;
       $employee->phone = $request->phone ;
       $employee->address = $request->address ;
       $employee->birthday = $request->birthday ;
       $employee->date_of_joining = $request->date_of_joining;
       $employee->department_id = $request->department_id;
       $employee->gender = $request->gender;
       $employee->status = $request->status;
       $employee->user_id = $user_id;

        if($request->photo){

            $img          = $request->photo;
            $fileName     = time().Str::random('10').'.'.$img->getClientOriginalExtension();;
            $img          = Image::make($img);

            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save(public_path('uploads/employee/photos/'. $fileName));
            $filenameEployee= 'uploads/employee/photos/'.$fileName;
            $employee->photo = $filenameEployee;
            unlink(public_path($employee->photo));

        }

        $employee->save();

        if( config('app.locale') == 'ar'){
            alert()->success('تم  التحديث  بنجاح', 'عمل رائع');
        }else{
            alert()->success('Updated Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.employees.index');

    }// end of update

    public function destroy($id){
       $employeeModel = $this->employeeModel::FindOrFail($id);
       $employeeModel->delete();
        unlink(public_path($employeeModel->photo));

        if( config('app.locale') == 'ar'){
            alert()->success('تم  الحذف  بنجاح', 'عمل رائع');
        }else{
            alert()->success('Deleted Successfully', 'Good Work');
        }


         return redirect()->route('dashboard.employees.index');
    }// end of destroy

    public function updateUser($request,$employee,$role,$status){
        $fileName = null;
        if($request->photo){

            $img          = $request->photo;
            $fileName     = time().Str::random('10').'.'.$img->getClientOriginalExtension();;
            $img          = Image::make($img);

            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save(public_path('uploads/users/photos/'. $fileName));


        }

        if($request->add_user == 1 && $employee->user_id > 0){

            $user=   User::FindOrFail($employee->user_id);
            $user->name = $request->name ;
            $user->phone = $request->phone ;
            $user->status = $status ;
            $user->email = $request->email_user ;
            $user->created_by = Auth::user()->id ;
            $user->role_id = $role ;
            ($request->password)?$user->password = Hash::make($request->password):'';
            ($request->photo)? $user->photo = $fileName:'';


            $user->save();
            $user->roles()->sync($request->role);

        }elseif($request->add_user == 1 && is_null($employee->user_id)){
            $user=   User::create([
                'name'       => $request->name,
                'phone'      => $request->phone,
                'status'     => $status,
                'photo'      => $fileName,
                'email'      => $request->email_user,
                'password'   => Hash::make($request->password),
                'created_by' => Auth::user()->id,
                'role_id' => $role,
            ]);
            $user->roles()->attach($request->role);

        }
       return (isset($user)) ?$user->id : null;
    }// update user


    public function profile($id){
        $row = $this->employeeModel->join('hr_departments', 'hr_departments.id', '=', 'hr_employees.department_id')
       ->select('hr_employees.*','hr_departments.name_en as department_en','hr_departments.name_ar as department_ar')

        ->FindOrFail($id);
        return view('backend.hrm.employees.profile',compact('row'));

    }

} // end of class

?>
