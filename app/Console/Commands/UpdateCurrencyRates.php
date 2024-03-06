<?php

namespace App\Console\Commands;

use App\Services\CurrencyRateService;
use Illuminate\Console\Command;

class UpdateCurrencyRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-currency-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CurrencyRateService $service): void
    {
        $service->fetchAndSaveRates();
        $this->info('Currency rates have been updated successfully.');
    }

}
