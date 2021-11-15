<?php

namespace App\Http\Controllers\BackEnd\Stores;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Stores\StoItemInterface;
use Illuminate\Http\Request;

class StoItemController extends Controller
{
     private $stoItemInterface;

    public function __construct(StoItemInterface $stoItemInterface){
        $this->stoItemInterface = $stoItemInterface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){
      return $this->stoItemInterface->index();
    }

    public function create(){
        return $this->stoItemInterface->create();
    }

    public function edit($id){
        return $this->stoItemInterface->edit($id);
      }

    public function store(Request $request){
      return $this->stoItemInterface->store($request);
    }

    public function selectUnits(Request $request){
        return $this->stoItemInterface->selectUnits($request);
      }


    public function update(Request $request ,$id){
      return $this->stoItemInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->stoItemInterface->destroy($id);
    }// end of destroy


}
