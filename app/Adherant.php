<?php

namespace App;
use App\Subsector;
use App\Payment;


use Illuminate\Database\Eloquent\Model;

class Adherant extends Model
{
 /**
     * Get  adherant's  subsector.
     */
    public function subsector()
    {
        return $this->belongsTo(Subsector::class);
    }
/**
     * Get  adherant's  payments.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
