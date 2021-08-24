<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User_Area extends Model
{
    public $timestamps = false;
    public $table = "user_areas";
    protected $fillable = [
        'name','companyId'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
