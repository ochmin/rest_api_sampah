<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Sampah extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sampahs';
    protected $fillable = [
        'kepala_keluarga',
        'no_rumah',
        'rt_rw',
        'kriteria',
        'total_karung_sampah',
        'tanggal_pengangkutan',
    ];

    public $timestamps = false;

}
