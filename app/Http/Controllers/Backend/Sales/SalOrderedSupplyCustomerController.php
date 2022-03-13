<?php

namespace App\Http\Controllers\Backend\Sales;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Sales\SalOrderedSupplyCustomerInterface;
use Illuminate\Http\Request;

class SalOrderedSupplyCustomerController extends Controller
{
    private $interface;

    public function __construct(SalOrderedSupplyCustomerInterface $interface){
        $this->interface = $interface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){
      return $this->interface->index();
    }

    public function create(Request $request){
        return $this->interface->create($request);
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
