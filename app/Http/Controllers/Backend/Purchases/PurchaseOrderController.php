<?php

namespace App\Http\Controllers\BackEnd\Purchases;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Purchases\PurchaseOrderInterface;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    private $interface;

    public function __construct(PurchaseOrderInterface $interface){
        $this->interface = $interface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){ 
      return $this->interface->index();
    }

    public function create(){
        return $this->interface->create();
      }

    public function show($id){
      return $this->interface->show($id);
    }

    public function search($value,$id){
        return $this->interface->search($value,$id);
      }// end of search

    public function edit($id){
        return $this->interface->edit($id);
      }

    public function store(Request $request){
      return $this->interface->store($request);
    }

    public function update(Request $request,$id){
      return $this->interface->update($request,$id);
    }

    public function destroy($id){
      return $this->interface->destroy($id);
    }// end of destroy
}
