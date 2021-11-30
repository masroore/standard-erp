<?php

namespace App\Http\Controllers\BackEnd\Hr;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Hr\HrEmployeeFileInterface;
use Illuminate\Http\Request;

class HrEmployeeFileController extends Controller
{
     private $employeeFilesInterface;

    public function __construct(HrEmployeeFileInterface $employeeFilesInterface){
        $this->employeeFilesInterface = $employeeFilesInterface ;
    }// end of constructor

    public function index(){
      return $this->employeeFilesInterface->index();
    }

    public function store(Request $request){
      return $this->employeeFilesInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->employeeFilesInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->employeeFilesInterface->destroy($id

    );
    }// end of destroy
}
