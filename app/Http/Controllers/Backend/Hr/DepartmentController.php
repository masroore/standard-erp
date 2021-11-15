<?php

namespace App\Http\Controllers\BackEnd\Hr;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Hr\DepartmentInterface;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
     private $departmentInterface;

    public function __construct(DepartmentInterface $departmentInterface){
        $this->departmentInterface = $departmentInterface ;
    }// end of constructor 

    public function index(){
      return $this->departmentInterface->index();
    }
    public function getById($id){
      return $this->departmentInterface->getById($id);
    }
    public function store(Request $request){
      return $this->departmentInterface->store($request);
    }

    public function update(Request $request){
      return $this->departmentInterface->update($request);
    }

    public function destroy(Request $request){
      return $this->departmentInterface->destroy($request);
    }// end of destroy 
}
