<?php

namespace App\Http\Interfaces\Stores;

interface StoCategoryInterface{

    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request,$id);
    public function exportExcell();
    public function destroy($id);

}// end of interface


?>
