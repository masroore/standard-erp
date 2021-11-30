<?php

namespace App\Http\Interfaces\Hr;

interface HrDepartmentInterface{

    public function index();

    public function getById($id);

    public function store($request);

    public function update($request,$id);

    public function destroy($id);

}// end of interface


?>
