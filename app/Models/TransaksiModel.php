<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];
    protected $casts = [
        'tanggal_masuk' => 'datetime',
        'estimasi_selesai' => 'date',
    ];

    public function layanan()
    {
        return $this->belongsTo(LayananModel::class, 'layanan_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusLayananModel::class, 'status_layanan_id');
    }

    public function logs()
    {
        return $this->hasMany(TransaksiStatusLogModel::class, 'transaksi_id')->orderBy('created_at');
    }

    public function pelanggan()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
