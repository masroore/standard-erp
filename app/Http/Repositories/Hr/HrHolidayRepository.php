<?php
namespace App\Http\Repositories\Hr;

use App\Http\Interfaces\Hr\HrHolidayInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Hr\HrHoliday;

use Illuminate\Support\Facades\Auth;
use Image;


class HrHolidayRepository implements HrHolidayInterface
{


    private $holidayModel;

    public function __construct(HrHoliday $holiday)
    {
        $this->holidayModel = $holiday;

    }

    public function index(){
       $rows =  $this->holidayModel::get();

       $routeName = 'holidays';
       return view('backend.hrm.holidays.index',compact('routeName','rows'));

    }//end of index




    public function store($request){
        $request->validate([
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'note' => 'required|string|unique:hr_holidays,note',
       ]);


       $requestArray = $request->all();
       $this->holidayModel::create($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم الانشاء  بنجاح', 'عمل رائع');
        }else{
            alert()->success(' Created Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.holidays.index');


    }// end of store

    public function update($request,$id){

        $request->validate([
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'note' => 'required|string|unique:hr_holidays,note,'.$id,
       ]);


       $requestArray = $request->all();
        $this->holidayModel::FindOrFail($id)->update($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم التعديل   بنجاح', 'عمل رائع');
        }else{
            alert()->success(' updated Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.holidays.index');


    }// end of update

    public function destroy($id){

        $this->holidayModel::FindOrFail($id)->delete();

        if( config('app.locale') == 'ar'){
            alert()->success('تم  الحذف  بنجاح', 'عمل رائع');
        }else{
            alert()->success('Deleted Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.holidays.index');
    }// end of destroy

} // end of class

?>
