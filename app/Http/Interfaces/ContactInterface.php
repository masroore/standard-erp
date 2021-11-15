<?php 

namespace App\Http\Interfaces;

interface ContactInterface{

    public function index();

    public function getById($id);

    public function store($request);

    public function update($request,$id);

    public function destroy($id); 

}// end of interface 


?> 