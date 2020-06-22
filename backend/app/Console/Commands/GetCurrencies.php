<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Services\GuzzleService;
use App\Repositories\CurrencyRepository;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;
use App\Exceptions\CurrencyException;

/**
 * Class GetCurrencies
 * @package App\Console\Commands
 */
class GetCurrencies extends Command
{
    protected const CURRENCY_API = 'https://www.cbr-xml-daily.ru/daily_json.js';

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
     * @var CurrencyRepository
     */
    protected $currencyRepository;

    /**
     * GetCurrencies constructor.
     * @param  CurrencyRepository  $currencyRepository
     */
    public function __construct(CurrencyRepository $currencyRepository)
    {
        parent::__construct();
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * Execute the console command.
     * Rewrite all records in currencies table
     *
     * @throws GuzzleException
     * @throws CurrencyException
     */
    public function handle(): void
    {
        try {
            $this->currencyRepository->delete();
            self::saveCurrencies();
            $this->info('Currencies were saved!');
        } catch (GuzzleException | CurrencyException $exception) {
            $this->error($exception->getMessage());
        }
    }

    /**
     * @throws GuzzleException
     * @throws CurrencyException
     */
    public static function saveCurrencies(): void
    {
        $currenciesApi = GuzzleService::get(self::CURRENCY_API);
        if (is_object($currenciesApi)) {
            $currencies = GuzzleService::decode($currenciesApi->getBody());
            if (!$currencies['Valute']) {
                throw new CurrencyException("Currency wasn't gotten");
            }
            foreach ($currencies['Valute'] as $currency) {
                $record = new Currency([
                    "currency_id" => $currency['ID'],
                    "num_code" => $currency['NumCode'],
                    "char_code" => $currency['CharCode'],
                    "nominal" => $currency['Nominal'],
                    "name" => $currency['Name'],
                    "value" => $currency['Value'],
                    "past_value" => $currency['Previous']
                ]);
                $record->save();
            }
        }
    }
}
