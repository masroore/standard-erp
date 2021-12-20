<?php

namespace App\Http\Controllers\BackEnd\Hr;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Hr\HrWorkdayInterface;
use Illuminate\Http\Request;

class HrWorkdayController extends Controller
{
     private $workdayInterface;

    public function __construct(HrWorkdayInterface $workdayInterface){
        $this->workdayInterface = $workdayInterface ;
    }// end of constructor

    public function index(){
      return $this->workdayInterface->index();
    }

    public function update(Request $request,$id){
      return $this->workdayInterface->update($request,$id);
    }

}
