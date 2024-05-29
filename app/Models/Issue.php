<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{

    use HasFactory;
    protected $guarded = ['id'];

    public function sepatu()
    {
        return $this->belongsTo(Sepatu::class);
    }
}
