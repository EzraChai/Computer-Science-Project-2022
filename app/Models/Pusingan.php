<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pusingan extends Model
{
    use HasFactory;

    protected $fillable = [
        'round',
    ];

    public function pertandingan()
    {
        return $this->belongsTo(Pertandingan::class);
    }

    public function markahPeserta()
    {
        return $this->hasMany(markahPeserta::class);
    }
}
