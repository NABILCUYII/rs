<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    use HasFactory;

    // nama tabel (opsional, kalau pakai default plural 'tindakans' tidak perlu ditulis)
    protected $table = 'tindakans';

    // kolom yang boleh diisi (fillable)
    protected $fillable = [
        'id_pasien',
        'dokter',
        'tindakan',
        'jumlah',
    ];
}
