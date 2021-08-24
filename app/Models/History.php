<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class History extends Model
{
    protected $fillable = [
        'userId','username','company','action','date'
    ];



   public static function Logs($message)
   {

      $C = Company::find(Auth::user()->companyId)->toArray();
      date_default_timezone_set("America/Los_Angeles");

   		History::create([
            'userId' => Auth::user()->id,
            'username' => Auth::user()->username,
            'company' => $C['name'],
            'action' => $message,
            'date' => date("Y-m-d H:i:s")
            ]);
   }
}
