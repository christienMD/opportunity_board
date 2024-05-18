<?php

namespace App\Console\Commands;

use App\Models\Opportunity;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredOpportunities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-expired-opportunities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $opportunitiesToDelete = Opportunity::where('created_at', '<=', Carbon::now()->subDays(30))->get();

        foreach ($opportunitiesToDelete as $opportunity) {
            $opportunity->delete();
        }

        $this->info('Expired opportunities have been successfully deleted.');
    }
}
