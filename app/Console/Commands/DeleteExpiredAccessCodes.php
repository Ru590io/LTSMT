<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AccessCode;
use Carbon\Carbon;

class DeleteExpiredAccessCodes extends Command
{
    protected $signature = 'accesscodes:delete-expired';
    protected $description = 'Deletes expired access codes from the database';

    public function handle()
    {
        $expiredCodesCount = AccessCode::where('expires_at', '<', Carbon::now('America/Puerto_Rico'))->delete();
        $this->info("Deleted $expiredCodesCount expired access codes.");
    }
}
