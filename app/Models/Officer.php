<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;

    protected $table = 'officers';

    protected $fillable = [
        'iduser'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function duesCategories()
    {
        return $this->hasMany(DuesCategory::class, 'petugas', 'id');
    }
}
