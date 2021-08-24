<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MaturityLevelsGroup extends Model
{
    public $timestamps = false;
    public $table = "maturity_levels_group";
    protected $fillable = [
        'name','companyId'
    ];
}
