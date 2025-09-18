<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateExpiredSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:update-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates subscriptions to expired status when their end time has passed.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get the current time as a Carbon instance.
        $now = Carbon::now();

        $this->info("Starting the process to update expired subscriptions at {$now->toDateTimeString()}.");

        // Find all subscriptions that are currently 'active' and have an 'end_time' in the past.
        $expiredSubscriptionsCount = Subscription::where('status', 'active')
            ->where('end_time', '<', $now)
            ->update(['status' => 'expired']);

        // Check if any subscriptions were updated and log the result.
        if ($expiredSubscriptionsCount > 0) {
            Log::info("Successfully updated {$expiredSubscriptionsCount} subscriptions to 'expired' status.");
            $this->info("Successfully updated {$expiredSubscriptionsCount} subscriptions to 'expired' status.");
        } else {
            // log message
            Log::info("No subscriptions needed to be updated at this time.");
            $this->info("No subscriptions needed to be updated at this time.");
        }

        return Command::SUCCESS;
    }
}