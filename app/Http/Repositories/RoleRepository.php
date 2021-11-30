<?php
namespace App\Http\Repositories;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Interfaces\RoleInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class RoleRepository  implements RoleInterface
{
    use ApiDesignTrait;

    protected function fillter($rows){

        $rows =  $rows->WhereRoleNot('super_admin')
       ->WhenSearch(request()->search)
       ->with('permissions')
       ->withCount('users');
       return $rows ;
   }
    public function index(){
       $roles =  Role::with('permissions')->withCount('users')->get();

       $routeName = 'roles';

        // return $this->ApiResponse(200, 'Done', null,  $roles);
        return view('backend.roles.index', compact('roles','routeName'));

    }//end of index
    public function create(){

        $routeName = 'roles';

         return view('backend.roles.create', compact('routeName'));

     }//end of create
    public function getAllPermissions(){
        $permissions = DB::table('permissions')->select('id','name','display_name')->get();

         return $this->ApiResponse(200, 'Done', null,  $permissions);
    }

    public function store($request){
    //    dd($request->all());

       $request->validate([
             'name' => 'required|unique:roles,name',
             'permissions' => 'required|array|min:1'
        ]);

    $role =   Role::create($request->all());
    $role->attachPermissions($request->permissions);

    alert()->success( __('site.data_added'), __('site.success'));
    return redirect()->route('dashboard.roles.index');



    }// end of store

    public function edit($id){
        $row =  Role::find($id);
        // dd($roles);

        $routeName = 'roles';
         return view('backend.roles.edit', compact('row','routeName'));

     }//end of edit

    public function update($request,$id){
        //dd(51451);
        $role =   Role::FindOrFail($id);
        //dd($role);
        $request->validate([
            'name' => 'required|unique:roles,name,' .  $id,
            'permissions' => 'required|array|min:1'
        ]);

        $role->update($request->all());
       // dd($request->permissions);
        $role->syncPermissions($request->permissions);

        alert()->success( __('site.data_updated'), __('site.success'));
        return redirect()->route('dashboard.roles.index');

    }// end of update

    public function destroy($id){
        Role::FindOrFail($id)->delete();
        alert()->success( __('site.data_deleted'), __('site.success'));
    return redirect()->route('dashboard.roles.index');
    }// end of destroy


} // end of class

?>
