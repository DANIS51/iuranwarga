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
        'payment_type',
        'period',
        'nominal',
        'status',
        'petugas'
    ];

    public function duesMembers()
    {
        return $this->hasMany(DuesMember::class, 'idduescategory');
    }

    public function officer()
    {
        return $this->belongsTo(Officer::class, 'petugas');
    }

    /**
     * Get the officer's name
     */
    public function getOfficerNameAttribute()
    {
        return $this->officer ? $this->officer->user->name : 'Tidak ada petugas';
    }
}
