<?php

namespace App\Http\Controllers\BackEnd\Stores;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Stores\StoBrandInterface;
use Illuminate\Http\Request;

class StoBrandController extends Controller
{
    private $stoBrandInterface;

    public function __construct(StoBrandInterface $stoBrandInterface){
        $this->stoBrandInterface = $stoBrandInterface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){
      return $this->stoBrandInterface->index();
    }

    public function store(Request $request){
      return $this->stoBrandInterface->store($request);
    }

    public function update(Request $request ,$id){
      return $this->stoBrandInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->stoBrandInterface->destroy($id);
    }// end of destroy
}
