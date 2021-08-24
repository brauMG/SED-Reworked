<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evidences extends Model
{
    //
    protected $primaryKey = 'evidenceId';

    protected $guarded = [];

    // protected $fillable = [
    //     'link',
    //     'userId'
    // ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
