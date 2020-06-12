<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Services\GuzzleService;
use GuzzleHttp\Exception\GuzzleException;
use UnexpectedValueException;

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
     * @return bool|mixed
     * @throws GuzzleException
     */
    public static function getApiCurrencies()
    {
        if ($json_currencies = GuzzleService::get(self::CURRENCY_API)) {
            return GuzzleService::decode($json_currencies->getBody());
        }
        return false;
    }

    /**
     * @throws GuzzleException
     * @throws UnexpectedValueException
     */
    public static function saveCurrencies(): void
    {
        if (!$currencies = self::getApiCurrencies()) {
            throw new UnexpectedValueException('Was gotten not array');
        }
        foreach ($currencies['Valute'] as $currency) {
            $recording = new self([
                "currency_id" => $currency['ID'],
                "num_code" => $currency['NumCode'],
                "char_code" => $currency['CharCode'],
                "nominal" => $currency['Nominal'],
                "name" => $currency['Name'],
                "value" => $currency['Value'],
                "past_value" => $currency['Previous']
            ]);
            $recording->save();
        }
    }
}
