<?php

namespace App\Http\Controllers\BackEnd\Stores;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Stores\PriceListInterface;
use Illuminate\Http\Request;

class PriceListController extends Controller
{
    private $PriceListInterface; 

    public function __construct(PriceListInterface $PriceListInterface){
        $this->PriceListInterface = $PriceListInterface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){
      return $this->PriceListInterface->index();
    }
    public function create(){
        return $this->PriceListInterface->create();
      }
    public function store(Request $request){
      return $this->PriceListInterface->store($request);
    }
    public function edit($id){
        return $this->PriceListInterface->edit($id);
      }
    public function update(Request $request ,$id){
      return $this->PriceListInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->PriceListInterface->destroy($id);
    }// end of destroy


    public function search($value){
        return $this->PriceListInterface->search($value);
      }// end of destroy
}
