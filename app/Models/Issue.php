<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{

    use HasFactory;
    protected $guarded = ['id'];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class);
    }

    public function issue()
    {
        return $this->hasOne(Issue::class);
    }
}
