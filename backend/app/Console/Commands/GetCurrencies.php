<?php

namespace App\Console\Commands;

use App\Currency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\GuzzleException;
use UnexpectedValueException;

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
    protected $signature = 'db:currencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill currencies database';

    /**
     * Execute the console command.
     *
     * @throws GuzzleException
     * @throws UnexpectedValueException
     */
    public function handle(): void
    {
        try {
            DB::table('currencies')->delete();
            Currency::saveCurrencies();
            $this->info('Currencies were saved!');
        } catch (GuzzleException | UnexpectedValueException $exception) {
            $this->error($exception->getMessage());
        }
    }
}
