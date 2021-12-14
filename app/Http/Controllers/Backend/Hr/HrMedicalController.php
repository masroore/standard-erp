<?php

namespace App\Http\Controllers\BackEnd\Hr;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Hr\HrMedicalInterface;
use Illuminate\Http\Request;

class HrMedicalController extends Controller
{
     private $medicalInterface;

    public function __construct(HrMedicalInterface $medicalInterface){
        $this->medicalInterface = $medicalInterface ;
    }// end of constructor

    public function index(){
      return $this->medicalInterface->index();
    }

    public function store(Request $request){
      return $this->medicalInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->medicalInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->medicalInterface->destroy($id

    );
    }// end of destroy
}
