<?php
namespace App\Http\Repositories\Hr;

use App\Http\Interfaces\Hr\HrRewardInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Hr\HrReward;
use App\Models\Hr\HrEmployee;
use Illuminate\Support\Facades\Auth;
use Image;


class HrRewardRepository implements HrRewardInterface
{


    private $rewardModel;

    public function __construct(HrReward $reward)
    {
        $this->rewardModel = $reward;

    }

    public function index(){
        //dd('welcome');
       $rows =  $this->rewardModel::join('hr_employees', 'hr_employees.id', '=', 'hr_rewards.employee_id')
       ->select('hr_rewards.*','hr_employees.name as employee_name')
       ->get();
       $employees =  HrEmployee::get();
       $routeName = 'rewards';
       return view('backend.hrm.rewards.index',compact('routeName','rows','employees'));

    }//end of index




    public function store($request){
        $request->validate([
            'employee_id' => 'required|numeric',
            'date' => 'required|date',
            'reason' => 'required|string',
            'amount' => 'required|numeric',
            'reward_type' => 'required|string',
       ]);


       $requestArray = $request->all();
       $this->rewardModel::create($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء قسم جديد بنجاح', 'عمل رائع');
        }else{
            alert()->success('User Created Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.rewards.index');


    }// end of store

    public function update($request,$id){

        $request->validate([
            'employee_id' => 'required|numeric',
            'date' => 'required|date',
            'reason' => 'required|string',
            'amount' => 'required|numeric',
            'reward_type' => 'required|string',
       ]);


       $requestArray = $request->all();
        $this->rewardModel::FindOrFail($id)->update($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم تعديل القسم  بنجاح', 'عمل رائع');
        }else{
            alert()->success('reward updated Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.rewards.index');


    }// end of update

    public function destroy($id){

        $this->rewardModel::FindOrFail($id)->delete();

        if( config('app.locale') == 'ar'){
            alert()->success('تم  الحذف  بنجاح', 'عمل رائع');
        }else{
            alert()->success('Deleted Successfully', 'Good Work');
        }


         return redirect()->route('dashboard.rewards.index');
    }// end of destroy

} // end of class

?>
