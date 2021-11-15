<?php

namespace App\Http\Interfaces\Settings;

interface TaxInterface{

    public function index();

    public function store($request);

    public function update($request,$id);

    public function destroy($id);


}// end of interface


?>
