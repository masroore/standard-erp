<?php

namespace App\Http\Interfaces\Sales;

interface SalPaymentInterface{

    public function index($request);

    public function store($request);

    public function show($id);

    public function update($request,$id);

    public function destroy($id);

    public function data();

}// end of interface


?>

