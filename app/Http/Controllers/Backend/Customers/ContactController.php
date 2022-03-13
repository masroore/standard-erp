<?php

namespace App\Http\Controllers\BackEnd\Customers;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\ContactInterface;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $contactInterface;

    public function __construct(ContactInterface $contactInterface){
        $this->contactInterface = $contactInterface ;
    }// end of constructor

    public function index(){
      return $this->contactInterface->index();
    }


    public function getById($id){
      return $this->contactInterface->getById($id);
    }// end of get by id

    public function store(Request $request){
      return $this->contactInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->contactInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->contactInterface->destroy($id);
    }// end of destroy
    public function search($value){
        return $this->contactInterface->search($value);
    }// end of search

    public function getByType($value){
    return $this->contactInterface->getByType($value);
    }// end of getByType

   


}
