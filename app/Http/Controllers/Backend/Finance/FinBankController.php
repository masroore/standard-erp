<?php

namespace App\Http\Controllers\BackEnd\Finance;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Finance\FinBankInterface;
use Illuminate\Http\Request;

class FinBankController extends Controller
{
    private $interface;

    public function __construct(FinBankInterface $interface){
        $this->interface = $interface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){
      return $this->interface->index();
    }

    public function store(Request $request){
      return $this->interface->store($request);
    }

    public function update(Request $request ,$id){
      return $this->interface->update($request,$id);
    }

    public function destroy($id){
      return $this->interface->destroy($id);
    }// end of destroy
}
