<?php

namespace App\Http\Interfaces\Purchases;

interface PurchaseOperationInterface{

    public function index();

    public function show($id);

    public function store($request);

    public function update($request,$id);

    public function destroy($id);

}// end of interface


?>
