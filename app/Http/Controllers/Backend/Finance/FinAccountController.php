<?php

namespace App\Http\Controllers\Backend\Finance;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Finance\FinAccountInterface;
use Illuminate\Http\Request;

class FinAccountController extends Controller
{
    private $finAccInterface;

    public function __construct(FinAccountInterface $finAccInterface){
        $this->finAccInterface = $finAccInterface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){
      return $this->finAccInterface->index(); 
    }

    public function create(){
        return $this->finAccInterface->create();
    }

    public function store(Request $request){
      return $this->finAccInterface->store($request);
    }

    public function edit($id){
        return $this->finAccInterface->edit($id);
      }// end of edit

    public function update(Request $request ,$id){
      return $this->finAccInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->finAccInterface->destroy($id);
    }// end of destroy
}
