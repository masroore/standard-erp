<?php

use App\Models\Finance\FinTransaction;
use App\Models\Purchase\BuyReceive;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

function is_active(string $routeName){

    return null !== request()->segment(4) && request()->segment(4) == $routeName ? 'active' : '' ;

}// end is_active

function is_active2(string $routeName){

    return null !== request()->segment(5) && request()->segment(5) == $routeName ? 'active' : '' ;

}// end is_active

function menu_active(string $routeName){

    return null !== request()->segment(3) && request()->segment(3) == $routeName ? 'active' : '' ;

}// end  menu_active

function menu_active2(string $routeName){

    return null !== request()->segment(4) && request()->segment(4) == $routeName ? 'active' : '' ;

}// end  menu_active

function menu_show(string $routeName){

    return null !== request()->segment(3) && request()->segment(3) == $routeName ? 'show' : '' ;

}// end  menu_active


function is_show(array $routeName){

   return null !== request()->segment(3) && in_array(request()->segment(3),$routeName) ? 'show' : '' ;

}// end is_show

function is_true(array $routeName){

    return null !== request()->segment(3) && in_array(request()->segment(3),$routeName) ? 'active' : '' ;

}// end is_true
function userName(int $id){
    // $user = User::where('id',$id)->first();
    // return $user->name ;
}

function autoCode($company,$type){

    $max = BuyReceive::count();
    if($max > 0){ $max = $max + 1; }elseif($max == 0){ $max = 1;}
    $date = date("dmy");
    return $company."-".$type."-".$date."-".$max;

}// END OF AUTO CODE

function transactionCode(){

    $max = FinTransaction::max('id');
    if($max > 0)
    {
        $max = $max + 1;
    }
    else
    {
        $max = 1;

    }

    return $max;

}// END OF AUTO CODE

?>
