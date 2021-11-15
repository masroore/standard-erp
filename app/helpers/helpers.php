<?php

use App\Models\User;
function is_active(string $routeName){

    return null !== request()->segment(3) && request()->segment(3) == $routeName ? 'active' : '' ;

}// end is_active

function is_show(array $routeName){

    return null !== request()->segment(3) && in_array(request()->segment(3),$routeName) ? 'show' : '' ;

}// end is_show

function is_true(array $routeName){
        return null !== request()->segment(3) && in_array(request()->segment(3),$routeName) ? 'true' : 'false' ;

}// end is_true
function userName(int $id){

    // $user = User::where('id',$id)->first();

    // return $user->name ;
}



?>
