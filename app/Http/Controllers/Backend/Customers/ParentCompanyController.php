<?php

namespace App\Http\Controllers\BackEnd\Customers;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\ParentCompanyInterface;
use Illuminate\Http\Request;

class ParentCompanyController extends Controller
{
     private $parentCompanyInterface;

    public function __construct(ParentCompanyInterface $parentCompanyInterface){
        $this->parentCompanyInterface = $parentCompanyInterface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){
      return $this->parentCompanyInterface->index();
    }

    public function store(Request $request){
      return $this->parentCompanyInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->parentCompanyInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->parentCompanyInterface->destroy($id);
    }// end of destroy
}
