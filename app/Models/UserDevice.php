<?php
// app/Models/UserDevice.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDevice extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'mac_address', 'device_name', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function latestSubscription()
    {
        return $this->subscriptions()->latest()->first();
    }

    public function status()
    {
        return $this->status;
    }
}
