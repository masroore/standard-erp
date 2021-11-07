<?php

namespace App\Http\Controllers\BackEnd\Stores;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Stores\StoUnitInterface;
use Illuminate\Http\Request;

class StoUnitController extends Controller
{
     private $stoUnitInterface;

    public function __construct(StoUnitInterface $stoUnitInterface){
        $this->stoUnitInterface = $stoUnitInterface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){
      return $this->stoUnitInterface->index();
    }

    public function create(){
      return $this->stoUnitInterface->create();
    }

    public function edit($id){
      return $this->stoUnitInterface->edit($id);
    }

    public function store(Request $request){
      return $this->stoUnitInterface->store($request);
    }

    public function update(Request $request ,$id){
      return $this->stoUnitInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->stoUnitInterface->destroy($id);
    }// end of destroy
}
