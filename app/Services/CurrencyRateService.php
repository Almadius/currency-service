<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\CurrencyRate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CurrencyRateService
{
    public function fetchAndSaveRates(): bool
    {
        try {
            $response = Http::retry(3, 100)->get('http://www.cbr.ru/scripts/XML_daily.asp');

            if ($response->successful()) {
                $xml = simplexml_load_string($response->body());
                $date = Carbon::createFromFormat('d.m.Y', (string)$xml['Date'])->format('Y-m-d');

                foreach ($xml->Valute as $valute) {
                    CurrencyRate::updateOrCreate(
                        [
                            'valute_id' => (string)$valute['ID'],
                            'date' => $date,
                        ],
                        [
                            'num_code' => (int)$valute->NumCode,
                            'char_code' => (string)$valute->CharCode,
                            'nominal' => (int)$valute->Nominal,
                            'name' => (string)$valute->Name,
                            'value' => (float)str_replace(',', '.', (string)$valute->Value),
                        ]
                    );
                }
                return true;
            } else {
                Log::error('Failed to fetch currency rates from CBR.');
                return false;
            }
        } catch (\Exception $e) {
            Log::error("Error fetching currency rates: {$e->getMessage()}");
            return false;
        }
    }

    public function getCurrentRates(): \Illuminate\Database\Eloquent\Collection
    {
        return CurrencyRate::all();
    }
}
