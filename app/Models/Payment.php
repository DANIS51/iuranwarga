<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'iduser',
        'idmember',
        'idduescategory',
        'period',
        'nominal',
        'petugas',
        'status',
        'payment_method',
        'payment_date',
        'notes',
        'bukti_pembayaran'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function member()
    {
        return $this->belongsTo(DuesMember::class, 'idmember');
    }

    public function duesCategory()
    {
        return $this->belongsTo(DuesCategory::class, 'idduescategory');
    }

    public function officer()
    {
        return $this->belongsTo(Officer::class, 'petugas');
    }

    public function getPaymentDetailsAttribute()
    {
        return [
            'member_name' => $this->member ? $this->member->member_name : 'Unknown',
            'category_name' => $this->duesCategory ? $this->duesCategory->name : 'Unknown',
            'officer_name' => $this->officer ? $this->officer->officer_name : 'Unknown',
            'amount' => $this->nominal,
            'status' => $this->status,
            'period' => $this->period
        ];
    }
    public function duesMembers()
    {
        return $this->hasMany(DuesMember::class, 'idpayment');
    }

}
