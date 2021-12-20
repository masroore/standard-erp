<?php

namespace App\Http\Controllers\BackEnd\Hr\Payroll;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Hr\Payroll\HrSalarySetupInterface;
use Illuminate\Http\Request;

class HrSalarySetupController extends Controller
{
     private $SalarySetupInterface;

    public function __construct(HrSalarySetupInterface $SalarySetupInterface){
        $this->SalarySetupInterface = $SalarySetupInterface ;
    }// end of constructor

    public function index(){
      return $this->SalarySetupInterface->index();
    }

    public function store(Request $request){
      return $this->SalarySetupInterface->store($request);
    }
    public function edit($id){
        return $this->SalarySetupInterface->edit($id);
    }
    public function update(Request $request,$id){
      return $this->SalarySetupInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->SalarySetupInterface->destroy($id

    );
    }// end of destroy
}
