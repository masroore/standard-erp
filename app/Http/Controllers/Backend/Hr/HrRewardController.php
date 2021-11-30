<?php

namespace App\Http\Controllers\BackEnd\Hr;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Hr\HrRewardInterface;
use Illuminate\Http\Request;

class HrRewardController extends Controller
{
     private $rewardInterface;

    public function __construct(HrRewardInterface $rewardInterface){
        $this->rewardInterface = $rewardInterface ;
    }// end of constructor

    public function index(){
      return $this->rewardInterface->index();
    }

    public function store(Request $request){
      return $this->rewardInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->rewardInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->rewardInterface->destroy($id

    );
    }// end of destroy
}
