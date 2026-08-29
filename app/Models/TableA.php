<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableA extends Model
{
    protected $table = 'table_a';

    protected $primaryKey = 'kode_toko_baru';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'kode_toko_baru',
        'kode_toko_lama',
    ];

    protected $casts = [
        'kode_toko_baru' => 'integer',
        'kode_toko_lama' => 'integer',
    ];
}
