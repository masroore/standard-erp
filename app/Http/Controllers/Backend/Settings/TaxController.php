<?php

namespace App\Http\Controllers\BackEnd\Settings;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Settings\TaxInterface;
use Illuminate\Http\Request;


class TaxController  extends Controller
{
     private $TaxInterface;

    public function __construct(TaxInterface $TaxInterface){
        $this->TaxInterface = $TaxInterface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){
      return $this->TaxInterface->index();
    }

    public function store(Request $request){
      return $this->TaxInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->TaxInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->TaxInterface->destroy($id);
    }// end of destroy
}
