<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;

    protected $table = 'officers';

    protected $fillable = [
        'iduser',
        'position'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function duesCategories()
    {
        return $this->hasMany(DuesCategory::class, 'petugas');
    }

    public function members()
    {
        return $this->hasManyThrough(
            DuesMember::class,
            DuesCategory::class,
            'petugas',
            'idduescategory',
            'id',
            'id'
        );
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'petugas');
    }

    public function getOfficerNameAttribute()
    {
        return $this->user ? $this->user->name : 'Unknown Officer';
    }

    public function getOfficerEmailAttribute()
    {
        return $this->user ? $this->user->email : 'No Email';
    }

    public function getTotalManagedMembersAttribute()
    {
        return $this->members()->count();
    }

    public function getTotalManagedCategoriesAttribute()
    {
        return $this->duesCategories()->count();
    }
}
