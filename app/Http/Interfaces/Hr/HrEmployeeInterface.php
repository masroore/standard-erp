<?php

namespace App\Http\Interfaces\Hr;

interface HrEmployeeInterface{

    public function index();
    public function create();
    public function getById($id);

    public function store($request);

    public function edit($id);

    public function update($request,$id);

    public function destroy($id);
    public function profile($id);

}// end of interface


?>
