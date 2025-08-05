<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    //
    protected $fillable = [
        'name',
        'username',
        'password',
        'nohp',
        'address',
        'level',

    ];
}
