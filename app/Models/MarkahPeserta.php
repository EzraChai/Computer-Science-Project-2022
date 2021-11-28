<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkahPeserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'peserta_id',
        'pusingan_id',
        'marks',
        'total_marks',
        'judge-1',
        'judge-2',
        'judge-3',
        'judge-4',
        'judge-5',
        'judge-6',
        'judge-7',
        'difficulty',
        'penalty',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function pusingan()
    {
        return $this->belongsTo(Pusingan::class);
    }
}
