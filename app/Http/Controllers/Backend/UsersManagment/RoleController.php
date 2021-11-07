<?php

namespace App\Http\Controllers\Backend\UsersManagment;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\RoleInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
     private $roleInterface;

    public function __construct(RoleInterface $roleInterface){
        $this->roleInterface = $roleInterface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){
      return $this->roleInterface->index();
    }// end of index
    public function create(){
        return $this->roleInterface->create();
      }// end of create

    public function edit($id){
    return $this->roleInterface->edit($id);
    }// end of edit
    public function getAllPermissions(){
      return $this->roleInterface->getAllPermissions();
    }// end of getAllPermissions

    public function store(Request $request){
      return $this->roleInterface->store($request);
    }// end of store new role

    public function update(Request $request ,$id){
      return $this->roleInterface->update($request, $id);
    }// end of update role

    public function destroy($id){
      return $this->roleInterface->destroy($id);
    }// end of destroy
}
