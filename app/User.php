<?php

namespace App;

use App\models\role_user;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    function commission()
    {
        return $this->hasMany(commission::class);
    }

    function commission_amount()
    {
        return $this->commission()->sum("commission");
    }

    function role_user()
    {
        var_dump(get_class(  $this->hasOne(role_user::class) ));

        return $this->hasOne(role_user::class);
    }

    function role()
    {
        return $this->role_user()->role;
    }
}
