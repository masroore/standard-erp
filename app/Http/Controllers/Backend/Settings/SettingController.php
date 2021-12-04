<?php

namespace App\Http\Controllers\BackEnd\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SettingController  extends Controller
{


    public function __construct(){
        $this->middleware('auth');
    }// end of constructor

    public function general(){
        $routeName = 'settings';
        return view('backend.settings.general', compact('routeName') );

    }// end of social links

    public function store(Request $request){

        setting(request()->all())->save();

        if( config('app.locale') == 'ar'){
            alert()->success('تم   حفظ الاعدادات بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Settings Saved Successfully', 'Good Work');
        }
        return redirect()->back();
    }// end of store
}
