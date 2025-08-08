<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuesMember extends Model
{
    use HasFactory;

    protected $table = 'dues_members';

    protected $fillable = [
        'iduser',
        'idduescategory'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function duesCategory()
    {
        return $this->belongsTo(DuesCategory::class, 'idduescategory');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'idmember');
    }

    public function officer()
    {
        return $this->hasOneThrough(
            Officer::class,
            DuesCategory::class,
            'id',
            'id',
            'idduescategory',
            'petugas'
        );
    }

    public function getMemberNameAttribute()
    {
        return $this->user ? $this->user->name : 'Unknown Member';
    }

    public function getMemberEmailAttribute()
    {
        return $this->user ? $this->user->email : 'No Email';
    }

    public function getTotalPaymentsAttribute()
    {
        return $this->payments()->sum('nominal');
    }

    public function getPaymentStatusAttribute()
    {
        $totalPaid = $this->total_payments;
        $expectedAmount = $this->duesCategory ? $this->duesCategory->nominal : 0;

        if ($totalPaid >= $expectedAmount) {
            return 'Lunas';
        } elseif ($totalPaid > 0) {
            return 'Sebagian';
        } else {
            return 'Belum Bayar';
        }
    }
}
