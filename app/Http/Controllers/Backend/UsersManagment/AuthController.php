<?php

namespace App\Http\Controllers\Backend\UsersManagment;

use App\Http\Controllers\Controller; 
use App\Http\Interfaces\AuthInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{ 
   
     private $authInterface; 

    public function __construct(AuthInterface $authInterface){
        $this->authInterface = $authInterface ;
    }// end of constructor 

    

    public function login(){
      return $this->authInterface->login();
    }

    public function logout(){
      return $this->authInterface->logout();
    }


   

}
