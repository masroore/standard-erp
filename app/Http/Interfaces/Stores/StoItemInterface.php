<?php

namespace App\Http\Interfaces\Stores;

interface StoItemInterface{

    public function index($request);

    public function create();

    public function edit($id);

    public function store($request);

    public function update($request,$id);

    public function destroy($id);

    public function search($value,$id);

    public function selectUnits($request);

    public function export();

    public function import($request);
    
    public function show($id);
}// end of interface


?>
