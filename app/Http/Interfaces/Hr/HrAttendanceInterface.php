<?php

namespace App\Http\Interfaces\Hr;

interface HrAttendanceInterface{

    public function index();


    public function store($request);

    public function update($request,$id);

    public function destroy($id);
    public function search($request);

}// end of interface


?>
