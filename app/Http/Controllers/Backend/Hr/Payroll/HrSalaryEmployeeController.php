<?php

namespace App\Http\Controllers\BackEnd\Hr\Payroll;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Hr\Payroll\HrSalaryEmployeeInterface;
use Illuminate\Http\Request;

class HrSalaryEmployeeController extends Controller
{
     private $SalaryEmployeeInterface;

    public function __construct(HrSalaryEmployeeInterface $SalaryEmployeeInterface){
        $this->SalaryEmployeeInterface = $SalaryEmployeeInterface ;
    }// end of constructor

    public function index($generate_id){
      return $this->SalaryEmployeeInterface->index($generate_id);
    }

    public function store(Request $request){
      return $this->SalaryEmployeeInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->SalaryEmployeeInterface->update($request,$id);
    }
    public function invoice($id){
        return $this->SalaryEmployeeInterface->invoice($id);
      }// end of destroy
    public function destroy($id){
      return $this->SalaryEmployeeInterface->destroy($id);
    }// end of destroy
}
