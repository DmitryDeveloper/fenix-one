<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use Illuminate\Http\JsonResponse;

/**
 * Class CurrencyController
 * @package App\Http\Controllers
 */
class CurrencyController extends Controller
{
    /**
     * @var CurrencyService
     */
    protected $currencyService;

    /**
     * CurrencyController constructor.
     * @param  CurrencyService  $currencyService
     */
    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $currencies = $this->currencyService->index();
        return response()->json(['currencies' => $currencies]);
    }
}
