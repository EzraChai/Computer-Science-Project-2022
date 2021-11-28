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
        'judge_1',
        'judge_2',
        'judge_3',
        'judge_4',
        'judge_5',
        'judge_6',
        'judge_7',
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
