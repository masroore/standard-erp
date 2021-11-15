<?php

namespace App\Http\Controllers\Backend\Sales;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Sales\SalInvoiceInterface;
use Illuminate\Http\Request;

class SalInvoiceController extends Controller
{
    private $SalInvoiceInterface;

    public function __construct(SalInvoiceInterface $SalInvoiceInterface){

        $this->SalInvoiceInterface = $SalInvoiceInterface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){
      return $this->SalInvoiceInterface->index();
    }

    public function create(){
        return $this->SalInvoiceInterface->create();
    }

    public function store(Request $request){
      return $this->SalInvoiceInterface->store($request);
    }

    public function edit($id){
        return $this->SalInvoiceInterface->edit($id);
      }// end of edit

    public function update(Request $request ,$id){
      return $this->SalInvoiceInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->SalInvoiceInterface->destroy($id);
    }// end of destroy

    public function search($value){
        return $this->SalInvoiceInterface->search($value);
      }// end of search
}
