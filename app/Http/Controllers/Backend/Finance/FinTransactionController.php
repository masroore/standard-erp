<?php

namespace App\Http\Controllers\BackEnd\Finance;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Finance\FinTransactionInterface;
use Illuminate\Http\Request;

class FinTransactionController extends Controller
{
    private $interface;

    public function __construct(FinTransactionInterface $interface){
        $this->interface = $interface ;
        $this->middleware('auth');
    }// end of constructor

    public function paymentToSupplier()
    {
      return  $this->interface->paymentToSupplier();
    }

    public function saveSupplierPayment(Request $request){
        return  $this->interface->saveSupplierPayment($request);
    }


    public function customerPayment()
    {
      return  $this->interface->customerPayment();
    }

    public function saveCustomerPayment(Request $request){
        return  $this->interface->saveCustomerPayment($request);
    }

    public function getAllChecks(){
        return  $this->interface->getAllChecks();
    }

    public function changeChekStatus(Request $request){
        return  $this->interface->changeChekStatus($request);
    }
}
