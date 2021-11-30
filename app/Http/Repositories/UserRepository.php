<?php
namespace App\Http\Repositories;
use App\Models\User;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Interfaces\UserInterface;
use App\Http\Repositories\LaravelLocalization;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;
use Auth;

class UserRepository  implements UserInterface
{
    use ApiDesignTrait;
    private $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function index(){

        $users = $this->userModel::where('created_by', '!=', 0)->get();
        return view('backend.users.index', compact('users'));
      // return $this->ApiResponse(200, 'Done', null,  $users);



    }//end of index

    public function create($request){
        $roles = Role::get();
        return view('backend.users.create',compact('roles'));
    }

    public function edit($id){
        $row =  $this->userModel
        ->join('role_user', 'role_user.user_id', '=', 'users.id')
        ->FindOrFail($id);

        $roles = Role::get();

        return view('backend.users.edit',compact('row','roles'));
    }

    public function allusers($request){
        datatables(User::select('name','email','status'))->toJson();
    }

    public function store($request){


       $request->validate([
        'name'     => 'required|min:3',
        'email'    => 'required|email|unique:users',
        'password' => 'required|min:8',
        ]);

            //    if($validation->fails())
            //    {
            //        return $this->ApiResponse(422,'Validation Error', $validation->errors());
            //    }

        $fileName = null;

        if($request->status){
            $status = $request->status;
        }else{
            $status = 0;
        }

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

        $user=   $this->userModel::create([
            'name'       => $request->name,
            'phone'      => $request->phone,
            'status'     => $status,
            'photo'      => $fileName,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'created_by' => Auth::user()->id
        ]);
        $user->roles()->attach($request->role);

        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء مستخدم جديد بنجاح', 'عمل رائع');
        }else{
            alert()->success('User Created Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.users.all');
       //return $this->ApiResponse(200, 'User Was Created');
    }// end of store


    public function update($request,$id){
        $user =    $this->userModel::FindOrFail($id);

        $validation = Validator::make($request->all(),[
            'name'       => 'required|min:3',
            'email'      => 'required|email|unique:users,email,'.$id,
            ]);

            // if($validation->fails())
            // {
            //     return $this->ApiResponse(422,'Validation Error', $validation->errors());
            // }


        $user->name       = $request->name ;
        $user->email      = $request->email ;
        $user->phone      = $request->phone ;
        $user->updated_by = Auth::user()->id ;

        if($request->password && $request->has('password') != ""){
            $user->password = Hash::make($request->password);
        }

        if($request->photo){

            $img          = $request->photo;
            $fileName     = time().Str::random('10').'.'.$img->getClientOriginalExtension();;
            $img          = Image::make($img);

            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save(public_path('uploads/users/photos/'. $fileName));

            $user->photo      = $fileName;
        }

        if($request->status){
            $user->status = $request->status;
        }else{
            $user->status = 0;
        }

        $user->save();
        // $user->attachRoles([$request->role]);
        $user->roles()->sync($request->role);

        if( config('app.locale') == 'ar'){
            alert()->success('تم تعديل بيانات المستخدم بنجاح', 'عمل رائع');
        }else{
            alert()->success('User Updated Successfully', 'Good Work');
        }

        return redirect()->route('dashboard.users.all');
        //return $this->ApiResponse(200, 'User Was Updated');
    }

    public function getUserById($id){
        $user =   $this->userModel::where('id', '=',$id)->get();
        return $this->ApiResponse(200, 'Done', null, $user );
    }// end of getUserById


    public function manageProfile($request,$id){

        $user =    $this->userModel::FindOrFail($id);
        $validation = Validator::make($request->all(),[
            'name'       => 'required|min:3',
            'email'      => 'required|email|unique:users,email,'.$id,
            ]);

            if($validation->fails())
            {
                return $this->ApiResponse(422,'Validation Error', $validation->errors());
            }

            if ($request->hasFile('photo')) {
                $file     = $request->file('photo');
                $fileName = time().Str::random(15).'.'.$file->getClientOriginalExtension();
                $img      = Image::make($request->file('photo'));
                $img->fit(150, 150);
                $img->save(public_path('uploads/users/profile/'. $fileName));
                $user->photo =  url('public/uploads/users/profile/' . $fileName);
            }

            $user->name       = $request->name ;
            $user->email      = $request->email ;
            $user->phone      = $request->phone ;

            if($request->password){
            $user->password = Hash::make($request->password);
            }

        $user->save();
        return $this->ApiResponse(200, 'Profile Was Updated');

    }// end of manage Profile

    public function editPassword($request,$id){
        $user = $this->userModel::FindOrFail($id);
        if($request->password){
        $user->password = Hash::make($request->password);
        }
        $user->save();
        return $this->ApiResponse(200, 'Password Was Updated');
    }// end of edit password

    public function destroy($id){
        $this->userModel::FindOrFail($id)->delete();

        if( config('app.locale') == 'ar'){
            alert()->success('تم حذف بيانات المستخدم بنجاح', 'عمل رائع');
        }else{
            alert()->success('User Deleted Successfully', 'Good Work');
        }
        return redirect()->route('dashboard.users.all');
        //return $this->ApiResponse(200, 'User Deleted Successfully', null);
    }// end of destroy
} // end of class

?>
