<?php

namespace App\Http\Interfaces\Finance;

interface FinBankInterface{

public function index();

public function store($request);

public function update($request,$id);

public function destroy($id);

}// end of interface


?>
