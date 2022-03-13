<?php

namespace App\Http\Controllers\BackEnd\Purchases;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Purchases\SupplierInterface;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    private $supplierInterface;

    public function __construct(SupplierInterface $supplierInterface){
        $this->supplierInterface = $supplierInterface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){
      return $this->supplierInterface->index();
    }

    public function create(){
        return $this->supplierInterface->create();
      }

    public function show($id){
      return $this->supplierInterface->show($id);
    }

    public function edit($id){
        return $this->supplierInterface->edit($id);
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

    public function supplierContacts($id){
        return $this->supplierInterface->supplierContacts($id);
    }
}
