<?php

namespace App\Http\Controllers\Backend\Hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\Hr\HrEmployeeInterface;

class HrEmployeeController extends Controller
{
    private $EmployeeInterface;

    public function __construct(HrEmployeeInterface $EmployeeInterface){
        $this->EmployeeInterface = $EmployeeInterface ;
    }// end of constructor

    public function index(){
      return $this->EmployeeInterface->index();
    }
    public function create(){
        return $this->EmployeeInterface->create();
    }

    public function getById($id){
      return $this->EmployeeInterface->getById($id);
    }
    public function store(Request $request){
      return $this->EmployeeInterface->store($request);
    }
    public function edit($id){
        return $this->EmployeeInterface->edit($id);
    }
    public function update(Request $request ,$id){
      return $this->EmployeeInterface->update($request ,$id);
    }

    public function destroy($id){
      return $this->EmployeeInterface->destroy($id);
    }// end of destroy


    public function profile($id){
        return $this->EmployeeInterface->profile($id);
      }// end of profile

}
