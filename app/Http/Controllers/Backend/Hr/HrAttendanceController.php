<?php

namespace App\Http\Controllers\BackEnd\Hr;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Hr\HrAttendanceInterface;
use Illuminate\Http\Request;

class HrAttendanceController extends Controller
{
     private $attendanceInterface;

    public function __construct(HrAttendanceInterface $attendanceInterface){
        $this->attendanceInterface = $attendanceInterface ;
    }// end of constructor

    public function index(){
      return $this->attendanceInterface->index();
    }

    public function store(Request $request){
      return $this->attendanceInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->attendanceInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->attendanceInterface->destroy($id);
    }// end of destroy

    public function search(Request $request){
        return $this->attendanceInterface->search($request);
    }
}
