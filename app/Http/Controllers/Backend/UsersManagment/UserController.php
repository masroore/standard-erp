<?php

namespace App\Http\Controllers\Backend\UsersManagment;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{


     private $userInterface;

    public function __construct(UserInterface $userInterface){
        $this->userInterface = $userInterface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){
      return $this->userInterface->index();
    }

    public function allusers(Request $request){
      return $this->userInterface->allusers($request);
    }

    public function create(Request $request){
      return $this->userInterface->create($request);
    }

    public function edit($id){
      return $this->userInterface->edit($id);
    }

    public function getUserById($id){
      return $this->userInterface->getUserById($id);
    }

    public function store(Request $request){
      return $this->userInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->userInterface->update($request,$id);
    }

    public function manageProfile(Request $request,$id){
      return $this->userInterface->manageProfile($request,$id);
    }

    public function editPassword(Request $request,$id){
      return $this->userInterface->editPassword($request,$id);
    }

    public function destroy($id){
      return $this->userInterface->destroy($id);
    }// end of destroy
}
