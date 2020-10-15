<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    public function car() {
      return $this->belongsTo('App\Models\Car');
    }
}
