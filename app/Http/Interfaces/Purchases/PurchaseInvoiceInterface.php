<?php

namespace App\Http\Interfaces\Purchases;

interface PurchaseInvoiceInterface{

    public function index();

    public function create();

    public function edit($id);

    public function show($id);

    public function store($request);

    public function update($request,$id);

    public function destroy($id);

    public function search($value,$id);

}// end of interface


?>
