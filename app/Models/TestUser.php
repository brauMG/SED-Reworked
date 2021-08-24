<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestUser extends Model
{
    public $table = "test_user";
    public $timestamps = false;

    protected $fillable = [
        'testId','userId'
    ];
}
