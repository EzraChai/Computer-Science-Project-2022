<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Peserta extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'identity',
        'secondIdentity',
        'name',
        'secondName',
        'school',
        'pertandingan_id'
    ];

    public function markahPeserta()
    {
        return $this->hasMany(MarkahPeserta::class);
    }
}
