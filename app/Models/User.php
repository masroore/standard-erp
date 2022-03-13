<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ,LogsActivity , LaratrustUserTrait ;

    protected $fillable = ['name','photo','status','created_by','updated_by','email', 'password', 'phone','role_id'];

    // activity log
    protected static $logAttributes           =  ['name','photo','status','updated_by','email', 'phone','role_id'];
    protected static $ignoreChangedAttributes =  ['password'];
    protected static $logName                 =  'user';
    protected static $logOnlyDirty            =  true;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['password','remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
