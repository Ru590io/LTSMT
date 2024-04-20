<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;

class MoveInactiveUsers extends Command
{
    protected $signature = 'users:deactivate';
    protected $description = 'Deactivates inactive users';

    public function handle()
    {
        /*$inactiveThreshold = Carbon::now()->subMonths(6); // Defines 6 months of inactivity as the threshold
        $users = User::where('last_active', '<', $inactiveThreshold)
                     ->where('is_active', true) // Select only currently active users
                     ->get();

        foreach ($users as $user) {
            $user->update(['is_active' => false]); // Set is_active to false instead of deleting
        }

        $this->info('Inactive users have been deactivated successfully.');*/
    }
}
