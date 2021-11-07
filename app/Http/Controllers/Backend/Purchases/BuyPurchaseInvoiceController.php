<?php

namespace App\Http\Controllers\BackEnd\Purchases;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Purchases\BuyPurchaseInvoiceInterface;
use Illuminate\Http\Request;

class BuyPurchaseInvoiceController extends Controller
{
    private $invoiceInterface;

    public function __construct(BuyPurchaseInvoiceInterface $invoiceInterface){
        $this->invoiceInterface = $invoiceInterface ;
    }// end of constructor

    public function index(){
      return $this->invoiceInterface->index();
    }

    public function create(){
        return $this->invoiceInterface->create();
      }

    public function show($id){
      return $this->invoiceInterface->show($id);
    }

    public function edit($id){
        return $this->invoiceInterface->edit($id);
      }

    public function store(Request $request){
      return $this->invoiceInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->invoiceInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->invoiceInterface->destroy($id);
    }// end of destroy
}
