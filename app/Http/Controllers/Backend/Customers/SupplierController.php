<?php

namespace App\Http\Controllers\BackEnd\Customers;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\SupplierInterface;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    private $supplierInterface;

    public function __construct(SupplierInterface $supplierInterface){
        $this->supplierInterface = $supplierInterface ;
    }// end of constructor 

    public function index(){
      return $this->supplierInterface->index();
    }

    public function getById($id){
      return $this->supplierInterface->getById($id);
    }

    public function store(Request $request){
      return $this->supplierInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->supplierInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->supplierInterface->destroy($id);
    }// end of destroy 
}
