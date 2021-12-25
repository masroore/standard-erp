<?php
namespace App\Http\Repositories\Hr;

use App\Http\Interfaces\Hr\HrWorkdayInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Hr\HrWorkday;
use App\Models\Hr\HrEmployee;
use Illuminate\Support\Facades\Auth;
use Image;


class HrWorkdayRepository implements HrWorkdayInterface
{


    private $workdayModel;

    public function __construct(HrWorkday $workday)
    {
        $this->workdayModel = $workday;

    }

    public function index(){
       $rows =  $this->workdayModel::get();

       $routeName = 'workdays';
       return view('backend.hrm.workdays.index',compact('routeName','rows'));

    }//end of index





    public function update($request,$id){
        $request->validate([
            'status' => 'required|numeric',
       ]);

       $WorkDay = $this->workdayModel::FindOrFail($id);
       $WorkDay->status = $request->status;
       if ($WorkDay->update()) {
           return 1;
       }
       return 0;
    }// end of update

} // end of class

?>
