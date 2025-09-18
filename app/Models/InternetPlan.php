<?php

// app/Models/InternetPlan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternetPlan extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'price', 'duration_minutes', 'speed_limit', 'status'];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
