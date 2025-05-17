<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lingkungan extends Model
{
    public function umat(){
        return $this->hasMany(Umat::class);
    }
}
