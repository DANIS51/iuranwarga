<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuesMember extends Model
{
    use HasFactory;

    protected $table = 'dues_members';

    const STATUS_LUNAS = 'lunas';
    const STATUS_BELUM_BAYAR = 'belum_bayar';
    const STATUS_BELUM_LUNAS = 'belum_lunas';

    protected $fillable = [
        'iduser', 'idduescategory', 'bulan', 'status', 'tanggal_bayar', 'idpayment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function duesCategory()
    {
        return $this->belongsTo(DuesCategory::class, 'idduescategory');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'idpayment');
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
            'id',       // Foreign key on dues_categories table
            'id',       // Foreign key on officers table
            'idduescategory', // Local key on dues_members table
            'petugas'   // Local key on dues_categories table (petugas = officer id)
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
        return Payment::where('iduser', $this->iduser)
            ->where('idduescategory', $this->idduescategory)
            ->where('status', 'completed')
            ->sum('nominal');
    }

    public function getPaymentStatusAttribute()
    {
        switch (strtolower($this->status)) {
            case self::STATUS_LUNAS:
                return 'lunas';
            case self::STATUS_BELUM_LUNAS:
                return 'belum_lunas';
            case self::STATUS_BELUM_BAYAR:
            default:
                return 'belum_bayar';
        }
    }

    public function getPaymentMessageAttribute()
    {
        switch ($this->status) {
            case self::STATUS_LUNAS:
                return 'Bayaran anda sudah lunas!!';
            case self::STATUS_SEBAGIAN:
                return 'Pembayaran sebagian telah diterima.';
            case self::STATUS_BELUM_BAYAR:
            default:
                return 'Belum ada pembayaran.';
        }
    }
}
