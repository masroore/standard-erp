<?php

namespace App\Http\Interfaces\Hr;

interface DepartmentInterface{

    public function index(); 
    
    public function getById($id);

    public function store($request);

    public function update($request);

    public function destroy($request); 

}// end of interface 


?> 