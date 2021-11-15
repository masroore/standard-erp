<?php 

namespace App\Http\Interfaces;

interface CustomerInterface{

    public function index();
 
    public function store($request);

    public function update($request,$id);

    public function destroy($id); 

    public function getById($id);

}// end of interface 


?> 