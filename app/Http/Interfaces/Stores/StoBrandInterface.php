<?php

namespace App\Http\Interfaces\Stores;

interface StoBrandInterface{

    public function index();  

    public function store($request);

    public function update($request,$id);

    public function destroy($id); 

}// end of interface  


?> 