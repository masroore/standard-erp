<?php

namespace App\Http\Controllers\BackEnd\Customers;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CustomerGroupInterface;
use Illuminate\Http\Request;


class CustomerGroupController extends Controller
{
     private $customerGroupInterface;

    public function __construct(CustomerGroupInterface $customerGroupInterface){
        $this->customerGroupInterface = $customerGroupInterface ;
    }// end of constructor 

    public function index(){
      return $this->customerGroupInterface->index();
    }

    public function store(Request $request){
      return $this->customerGroupInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->customerGroupInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->customerGroupInterface->destroy($id);
    }// end of destroy 
}
