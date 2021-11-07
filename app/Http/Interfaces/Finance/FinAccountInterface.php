<?php

namespace App\Http\Interfaces\Finance;

interface FinAccountInterface{

public function index();

public function create();

public function edit();

public function store($request);

public function update($request,$id);

public function destroy($id);

}// end of interface


?>  
