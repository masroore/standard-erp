<?php

namespace App\Http\Controllers\BackEnd\Hr\Payroll;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Hr\Payroll\HrSalaryTypeInterface;
use Illuminate\Http\Request;

class HrSalaryTypeController extends Controller
{
     private $SalarTypeInterface;

    public function __construct(HrSalaryTypeInterface $SalarTypeInterface){
        $this->SalarTypeInterface = $SalarTypeInterface ;
    }// end of constructor

    public function index(){
      return $this->SalarTypeInterface->index();
    }

    public function store(Request $request){
      return $this->SalarTypeInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->SalarTypeInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->SalarTypeInterface->destroy($id

    );
    }// end of destroy
}
