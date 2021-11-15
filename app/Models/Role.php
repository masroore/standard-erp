<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    protected $fillable = ['name'];

    public function getNameAttribute($value){
        return ucfirst($value);
    }// end of getNameAttribute

    public function scopeWhenSearch($query , $search){
        return $query->when($search, function($q) use ($search){
            return $q->where('name' , 'like' , "%$search%");
        });
    }// end of scope when search

    public function scopeWhereRoleNot($query , $role_name){

        return $query->whereNotIn('name', (array)$role_name );

    }//end of scopeWhereRoleNot

    public function users_count(){

        return$this->belongsToMany(RoleUser::class,'role_user');

    }//end of scopeWhereRoleNot
}
