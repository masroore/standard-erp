<?php

namespace App\Http\Controllers\BackEnd\Stores;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Stores\StoStoreInterface;
use Illuminate\Http\Request;

class StoStoreController extends Controller
{
     private $stoStoreInterface;

    public function __construct(StoStoreInterface $stoStoreInterface){
        $this->stoStoreInterface = $stoStoreInterface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){
      return $this->stoStoreInterface->index();
    }

    public function store(Request $request){
      return $this->stoStoreInterface->store($request);
    }

    public function update(Request $request ,$id){
      return $this->stoStoreInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->stoStoreInterface->destroy($id);
    }// end of destroy
}
