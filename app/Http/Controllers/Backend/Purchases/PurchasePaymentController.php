<?php

namespace App\Http\Controllers\BackEnd\Purchases;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Purchases\PurchasePaymentInterface;
use Illuminate\Http\Request;

class PurchasePaymentController extends Controller
{
    private $interface;

    public function __construct(PurchasePaymentInterface $interface){
        $this->interface = $interface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(Request $request){
      return $this->interface->index($request);
    }
    public function data(){
        return $this->interface->data();
    }
    public function store(Request $request){
      return $this->interface->store($request);
    }

    public function show($id){
        return $this->interface->show($id);
    }

    public function update(Request $request,$id){
      return $this->interface->update($request,$id);
    }

    public function destroy($id){
      return $this->interface->destroy($id);
    }// end of destroy
}
