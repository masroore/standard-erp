<?php

namespace App\Http\Interfaces\Stores;

interface PriceListInterface{

    public function index();
    public function create();

    public function store($request);
    public function edit($id);

    public function update($request,$id);

    public function destroy($id);
    public function search($value);

}// end of interface

   
?>
