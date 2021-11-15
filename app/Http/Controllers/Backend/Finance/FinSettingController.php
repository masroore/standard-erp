<?php

namespace App\Http\Controllers\Backend\Finance;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Finance\FinSettingInterface;
use Illuminate\Http\Request;

class FinSettingController extends Controller
{
    private $FinSettingInterface;

    public function __construct(FinSettingInterface $FinSettingInterface){

        $this->FinSettingInterface = $FinSettingInterface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){

      return $this->FinSettingInterface->index();
    }

    public function create(){
        return $this->FinSettingInterface->create();
    }

    public function store(Request $request){
      return $this->FinSettingInterface->store($request);
    }

    public function edit($id){
        return $this->FinSettingInterface->edit($id);
      }// end of edit

    public function update(Request $request ,$id){
      return $this->FinSettingInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->FinSettingInterface->destroy($id);
    }// end of destroy
}
