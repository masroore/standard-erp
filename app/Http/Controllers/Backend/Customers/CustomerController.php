<?php

namespace App\Http\Controllers\BackEnd\Customers;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CustomerInterface;
use Illuminate\Http\Request;


class CustomerController  extends Controller
{
     private $customerInterface;

    public function __construct(CustomerInterface $customerInterface){
        $this->customerInterface = $customerInterface ;
    }// end of constructor

    public function index(){
      return $this->customerInterface->index();
    }
    public function create(){
        return $this->customerInterface->create();
    }
    public function edit($id){
    return $this->customerInterface->edit($id);
    }
    public function show($id){
    return $this->customerInterface->show($id);
    }
    public function getById($id){
      return $this->customerInterface->getById($id);
    }

    public function store(Request $request){
      return $this->customerInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->customerInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->customerInterface->destroy($id);
    }// end of destroy
}
