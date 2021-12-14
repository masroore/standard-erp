<?php

namespace App\Http\Controllers\BackEnd\Hr;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Hr\HrDepartmentInterface;
use Illuminate\Http\Request;

class HrDepartmentController extends Controller
{
     private $departmentInterface;

    public function __construct(HrDepartmentInterface $departmentInterface){
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

    public function update(Request $request,$id){
      return $this->departmentInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->departmentInterface->destroy($id

    );
    }// end of destroy
}
