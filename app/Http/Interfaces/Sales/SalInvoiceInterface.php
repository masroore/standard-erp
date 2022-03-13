<?php

namespace App\Http\Interfaces\Sales;

interface SalInvoiceInterface{

    public function index();

    public function create();

    public function store($request);

    public function edit($id);

    public function getDeliversToCreateInvoice($customer);
    
    public function getDeliversItemsToCreateInvoice($items);

    public function update($request ,$id);

    public function destroy($id);

    public function search($value,$id);

}// end of interface


?>
