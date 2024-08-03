<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function sepatu()
    {
        return $this->belongsTo(Sepatu::class);
    }

    public function issue()
    {
        return $this->hasMany(Issue::class);
    }
}
