<?php 

namespace App\Http\Interfaces;

interface UserInterface{

    public function index(); 
    public function allusers($request);
    public function getUserById($id);

    public function create($request);

    public function edit($id);

    public function store($request);

    public function update($request,$id);

    public function manageProfile($request,$id);

    public function editPassword($request,$id);

    public function destroy($id); 


}// end of interface 


?>
 