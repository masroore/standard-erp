<?php

namespace App\Http\Interfaces;

interface CustomerInterface{

    public function index();

    public function store($request);

    public function update($request,$id);
    public function customerContacts($id);
    public function create();
    public function edit($id);
    public function show($id);

    public function destroy($id);

    public function getById($id);

}// end of interface


?>
