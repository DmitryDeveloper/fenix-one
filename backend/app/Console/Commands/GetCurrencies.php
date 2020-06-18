<?php

namespace App\Console\Commands;

use App\Models\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use App\Exceptions\CurrencyException;

/**
 * Class GetCurrencies
 * @package App\Console\Commands
 */
class GetCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:getting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currencies table';

    /**
     * Execute the console command.
     * Сommand rewrite all records in currencies table
     *
     * @throws GuzzleException
     * @throws CurrencyException
     */
    public function handle(): void
    {
        try {
            DB::table('currencies')->delete();
            Currency::saveCurrencies();
            $this->info('Currencies were saved!');
        } catch (GuzzleException | CurrencyException $exception) {
            $this->error($exception->getMessage());
        }
    }
}
