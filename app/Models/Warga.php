<?php

namespace App\Models;

use App\Models\Agama;
use App\Models\Pekerjaan;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $guarded = [];

    public function agama()
{
    return $this->belongsTo(Agama::class, 'agama_id');
}

public function pekerjaan()
{
    return $this->belongsTo(Pekerjaan::class, 'pekerjaan_id');
}
}
