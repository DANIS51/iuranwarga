<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuesCategory extends Model
{
    use HasFactory;

    protected $table = 'dues_categories';

    protected $fillable = [
        'name',
        'period',
        'nominal',
        'status'
    ];

    public function duesMembers()
    {
        return $this->hasMany(DuesMember::class, 'idduescategory');
    }
}
