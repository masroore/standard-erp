<?php

namespace App\Http\Interfaces\Hr\Payroll;

interface HrSalaryGenerateInterface{

    public function index();


    public function store($request);

    public function update($request,$id);

    public function destroy($id);

}// end of interface


?>
