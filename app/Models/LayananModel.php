<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananModel extends Model
{
    protected $table = 'layanan';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];

    public function status()
    {
        return $this->hasMany(StatusLayananModel::class, 'layanan_id')->orderBy('urutan');
    }
}
