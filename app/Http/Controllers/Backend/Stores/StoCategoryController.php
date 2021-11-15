<?php

namespace App\Http\Controllers\BackEnd\Stores;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Stores\StoCategoryInterface;
use Illuminate\Http\Request;

class StoCategoryController extends Controller
{
     private $stoCategoryInterface;

    public function __construct(StoCategoryInterface $stoCategoryInterface){
        $this->stoCategoryInterface = $stoCategoryInterface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){
      return $this->stoCategoryInterface->index();
    }

    public function create(){
      return $this->stoCategoryInterface->create();
    }

    public function edit($id){
      return $this->stoCategoryInterface->edit($id);
    }

    public function store(Request $request){
      return $this->stoCategoryInterface->store($request);
    }

    public function update(Request $request ,$id){
      return $this->stoCategoryInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->stoCategoryInterface->destroy($id);
    }// end of destroy
}
