<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertandingan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'avenue',
        'date',
    ];

    public function pusingan()
    {
        return $this->hasMany(Pusingan::class);
    }
}
