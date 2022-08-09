<?php

namespace App;
use App\Adherant;


use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
   /**
     * Get  adherant's  subsector.
     */
    public function adherant()
    {
        return $this->belongsTo(Adherant::class);
    }
}
