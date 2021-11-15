<?php 

namespace App\Http\Interfaces;

interface CustomerGroupInterface{

    public function index();

    public function store($request);

    public function update($request,$id);

    public function destroy($id); 

}// end of interface 


?>
 