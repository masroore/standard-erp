<?php

namespace App\Http\Interfaces;

interface RoleInterface{

    public function index();
    public function create();
    public function edit($id);
    public function getAllPermissions();
    public function store($request);
    public function update($request ,$id);
    public function destroy($id);

}// end of interface


?>
