<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SponsorsCompanies extends Model
{
    public $table  = "sponsors_companies";
    public $timestamps = false;
    protected $fillable = [
        'sponsorId','companyId'
    ];
}
