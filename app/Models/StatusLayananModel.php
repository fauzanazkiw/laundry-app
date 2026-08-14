<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusLayananModel extends Model
{
    protected $table = 'status_layanan';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];

    public function layanan()
    {
        return $this->belongsTo(LayananModel::class, 'layanan_id');
    }
}
