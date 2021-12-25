<?php

namespace App\Http\Controllers\BackEnd\Hr;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Hr\HrHolidayInterface;
use Illuminate\Http\Request;

class HrHolidayController extends Controller
{
     private $holidayInterface;

    public function __construct(HrHolidayInterface $holidayInterface){
        $this->holidayInterface = $holidayInterface ;
    }// end of constructor

    public function index(){
      return $this->holidayInterface->index();
    }

    public function store(Request $request){
      return $this->holidayInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->holidayInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->holidayInterface->destroy($id

    );
    }// end of destroy
}
