<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class RoleUser extends LaratrustRole
{
    protected $fillable = ['user_id','role_id'];

    protected $table = 'role_user';

}
