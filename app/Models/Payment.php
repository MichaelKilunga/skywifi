<?php
// app/Models/Payment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = ['subscription_id', 'transaction_id', 'amount', 'status', 'phone', 'response', 'paid_at'];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
