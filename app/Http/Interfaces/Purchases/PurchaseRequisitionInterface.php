<?php

namespace App\Http\Interfaces\Purchases;

interface PurchaseRequisitionInterface{

    public function index();

    public function create($request);

    public function edit($id);

    public function show($id);

    public function store($request);

    public function update($request,$id);

    public function destroy($id);

    public function search($value,$id);

    public function offerPriceRequest($id);

    public function showOfferPriceRequest($id);

    public function replyOfferPriceRequest($id);

}// end of interface


?>
