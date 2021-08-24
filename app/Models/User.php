<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','firstName','lastName', 'email', 'password', 'companyId'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function giveMeRole(User $user)
    {
        return $user->roles()->where('name')->first();
    }
    public static function giveMeCompany(User $user)
    {
        return $user->companyId;
    }

    public static function companyName()
    {
        $companyId = User::giveMeCompany(Auth::user());
        $companyData = Company::where('companyId', '=', $companyId)->first();
//        dd($companyData['name']);
        return $companyData['name'];
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function areas()
    {
        return $this->belongsToMany(Area::class, 'user_areas', 'userId','areaId');
    }
    public function evidences()
    {
        return $this->hasMany(Evidences::class,'userId');
    }
}
