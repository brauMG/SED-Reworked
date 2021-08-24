<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role_User extends Model
{
    public $timestamps = false;
    protected $fillable = ['role_id', 'user_id'];

    public $table = "role_user";
      public function users()
      {
        return $this->belongsToMany(User::class);
      }
}
