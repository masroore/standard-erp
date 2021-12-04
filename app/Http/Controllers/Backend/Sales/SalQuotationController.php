<?php

namespace App\Http\Controllers\Backend\Sales;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Sales\SalQuotationInterface;
use Illuminate\Http\Request;

class SalQuotationController extends Controller
{
    private $interface;

    public function __construct(SalQuotationInterface $interface){

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
    public function store(Request $request){
      return $this->interface->store($request);
    }

    public function edit($id){
        return $this->interface->edit($id);
      }// end of edit

    public function update(Request $request ,$id){
      return $this->interface->update($request,$id);
    }

    public function destroy($id){
      return $this->interface->destroy($id);
    }// end of destroy

    public function search($value,$id){
        return $this->interface->search($value,$id);
      }// end of search
}
