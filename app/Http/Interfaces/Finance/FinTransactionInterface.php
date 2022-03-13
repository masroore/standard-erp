<?php

namespace App\Http\Interfaces\Finance;

interface FinTransactionInterface
{

 public function paymentToSupplier();

 public function saveSupplierPayment($request);

 public function customerPayment();

 public function saveCustomerPayment($request);

 public function getAllChecks();

 public function changeChekStatus($request);

}// end of interface


?>
