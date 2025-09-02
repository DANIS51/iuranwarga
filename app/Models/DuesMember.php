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
        'idduescategory',
        'status'
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
        // Use the persistent status field instead of computed
        switch ($this->status) {
            case 'lunas':
                return 'Lunas';
            case 'sebagian':
                return 'Sebagian';
            case 'belum_bayar':
            default:
                return 'Belum Bayar';
        }
    }

    public function getPaymentMessageAttribute()
    {
        switch ($this->status) {
            case 'lunas':
                return 'Bayaran anda sudah lunas!!';
            case 'sebagian':
                return 'Pembayaran sebagian telah diterima.';
            case 'belum_bayar':
            default:
                return 'Belum ada pembayaran.';
        }
    }
}
