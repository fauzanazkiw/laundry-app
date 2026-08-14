<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiStatusLogModel extends Model
{
    protected $table = 'transaksi_status_log';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($log) {
            $log->created_at = $log->created_at ?? now();
        });
    }
}
