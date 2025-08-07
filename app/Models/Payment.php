<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'create_payment_tables';

    protected $fillable = [
        'iduser',
        'period',
        'nominal',
        'petugas',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
