<?php

namespace App\Http\Interfaces\Hr\Payroll;

interface HrSalaryEmployeeInterface{

    public function index($generate_id);


    public function store($request);

    public function update($request,$id);
    public function invoice($id);

    public function destroy($id);

}// end of interface


?>
