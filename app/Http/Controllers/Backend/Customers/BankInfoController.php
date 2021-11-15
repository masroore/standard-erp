<?php

namespace App\Http\Controllers\BackEnd\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Interfaces\BankInfoInterface;


class BankInfoController extends Controller
{
   private $bankInfoInterface;

    public function __construct(BankInfoInterface $bankInfoInterface){
        $this->bankInfoInterface = $bankInfoInterface ;
    }// end of constructor 

    public function index(){
      return $this->bankInfoInterface->index();
    }
    public function getById($id){
       return $this->bankInfoInterface->getById($id);
    }
    public function store(Request $request){
      return $this->bankInfoInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->bankInfoInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->bankInfoInterface->destroy($id);
    }// end of destroy 
}
 