<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Adherant;


class Subsector extends Model
{
    /**
     * Get the adherant from subsector.
     */
    public function adherant()
    {
        return $this->hasMany(Adherant::class);
    }
}
