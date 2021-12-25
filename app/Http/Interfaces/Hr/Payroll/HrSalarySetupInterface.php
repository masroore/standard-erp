<?php

namespace App\Http\Interfaces\Hr\Payroll;

interface HrSalarySetupInterface{

    public function index();


    public function store($request);
    public function edit($id);

    public function update($request,$id);

    public function destroy($id);

}// end of interface


?>
