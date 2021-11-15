<?php 
   namespace App\Http\Interfaces;

    interface AuthInterface{


        

        public function login();

        public function me();

        public function logout();
 
        public function refresh();

        
 


    }// end of interface 
?>