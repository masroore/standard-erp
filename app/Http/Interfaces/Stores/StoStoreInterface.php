<?php

namespace App\Http\Interfaces\Stores;

interface StoStoreInterface{

    public function index();  

    public function store($request);

    public function update($request,$id);

    public function destroy($id); 

}// end of interface  


?> 