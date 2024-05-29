<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sepatu extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function issue()
    {
        return $this->hasMany(Issue::class);
    }
}
