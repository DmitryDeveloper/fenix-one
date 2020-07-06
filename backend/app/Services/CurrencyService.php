<?php

namespace App\Services;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CurrencyService
 * @package App\Services
 */
class CurrencyService
{
    /**
     * @var Currency
     */
    private $currency;

    /**
     * CurrencyService constructor.
     * @param  Currency  $currency
     */
    public function __construct(
        Currency $currency
    ) {
        $this->currency = $currency;
    }

    /**
     * @return Currency[]|Collection
     */
    public function index()
    {
        return $this->currency->getAll();
    }
}
