<?php

namespace App\Admin;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Admin extends Authenticatable
{
    use Notifiable , HasApiTokens;



    public function role()
    {
        return $this->belongsTo('App\SuperAdmin\Role', 'role_id')->select('id', 'roles');
    }
    public function subAdminRole()
    {
        return $this->belongsTo('App\Admin\AdminRole', 'role_id')->select('id', 'roles');
    }
}
