<?php

namespace App\Http\Interfaces\Sales;

interface SalDeliverInterface{

    public function index();

    public function create($request);

    public function edit($id);

    public function show($id);

    public function store($request);

    public function update($request,$id);

    public function destroy($id);

    public function search($value,$id);

}// end of interface


?>
