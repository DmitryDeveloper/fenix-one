<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\GuzzleService;
use GuzzleHttp\Exception\GuzzleException;
use App\Exceptions\CurrencyException;

/**
 * Class Currency
 * @package App
 */
class Currency extends Model
{
    protected const CURRENCY_API = 'https://www.cbr-xml-daily.ru/daily_json.js';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'currency_id',
        'num_code',
        'char_code',
        'nominal',
        'name',
        'value',
        'past_value'
    ];

    /**
     * @throws GuzzleException
     * @throws CurrencyException
     */
    public static function saveCurrencies(): void
    {
        $currencies = GuzzleService::get(self::CURRENCY_API);
        if (!$currencies['Valute']) {
            throw new CurrencyException("Currency wasn't gotten");
        }
        foreach ($currencies['Valute'] as $currency) {
            $record = new self([
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
