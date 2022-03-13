<?php

namespace App\Http\Interfaces;

interface ContactInterface{

    public function index();

    public function getById($id);

    public function store($request);

    public function update($request,$id);

    public function destroy($id);
    public function search($value);
    public function getByType($value);

}// end of interface


?>
