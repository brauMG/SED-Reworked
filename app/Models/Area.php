<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'name','companyId'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_areas', 'userId','areaId');
    }


}
