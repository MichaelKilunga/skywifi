<?php
// app/Models/Subscription.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_device_id', 'internet_plan_id', 'status', 'start_time', 'end_time'];

    public function device()
    {
        return $this->belongsTo(UserDevice::class, 'user_device_id');
    }

    public function plan()
    {
        return $this->belongsTo(InternetPlan::class, 'internet_plan_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function remainingTime()
    {
        if ($this->status !== 'active' || !$this->end_time) {
            return 0;
        }

        $now = now();
        $end = \Carbon\Carbon::parse($this->end_time);

        return max(0, $end->diffInSeconds($now, false));
    }
}
