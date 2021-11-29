<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Pertandingan extends Model
{
    use HasFactory, Searchable;

    public function searchableAs()
    {
        return 'pertandingans';
    }

    protected $fillable = [
        'name',
        'avenue',
        'date',
        'type',
    ];

    public function pusingan()
    {
        return $this->hasMany(Pusingan::class);
    }
}
