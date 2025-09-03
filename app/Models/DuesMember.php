<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuesMember extends Model
{
    use HasFactory;

    protected $table = 'dues_members';

    
    // App\Models\DuesMember.php

 
   

    const STATUS_LUNAS = 'lunas';
    const STATUS_BELUM_BAYAR = 'belum_bayar';

    // relasi dan atribut lainnya...
 
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
        return \App\Models\Payment::where('iduser', $this->iduser)
            ->where('idduescategory', $this->idduescategory)
            ->where('status', 'completed')
            ->sum('nominal');
    }

    public function getPaymentStatusAttribute()
    {
        // Use the persistent status field instead of computed
        switch (strtolower($this->status)) {
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
