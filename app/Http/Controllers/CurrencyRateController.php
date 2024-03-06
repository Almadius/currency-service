<?php

namespace App\Http\Controllers;

use App\Services\CurrencyRateService;
use Illuminate\Http\Request;

class CurrencyRateController extends Controller
{
    protected CurrencyRateService $currencyRateService;

    public function __construct(CurrencyRateService $currencyRateService)
    {
        $this->currencyRateService = $currencyRateService;
    }

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($this->currencyRateService->fetchAndSaveRates()) {
            $rates = $this->currencyRateService->getCurrentRates();
            return response()->json($rates);
        } else {
            return response()->json(['error' => 'Service Unavailable'], 503);
        }
    }
}
