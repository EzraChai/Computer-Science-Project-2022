<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'identity',
        'name',
        'school',
        'pertandingan_id'
    ];

    public function markahPeserta()
    {
        return $this->hasMany(MarkahPeserta::class);
    }
}
