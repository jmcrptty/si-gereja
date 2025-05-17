<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umat extends Model
{
    public function lingkungan(){
        return $this->belongsTo(Lingkungan::class);
    }
}
