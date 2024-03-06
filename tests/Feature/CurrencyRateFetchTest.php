<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CurrencyRateFetchTest extends TestCase
{
    public function testSuccessfulCurrencyRateFetch()
    {
        Http::fake([
            'www.cbr.ru/scripts/XML_daily.asp' => Http::response($this->mockSuccessfulResponse(), 200)
        ]);

        $response = $this->get('/api/currency-rates');

        $response->assertStatus(200);
    }

    public function testCurrencyRateFetchWithServerError()
    {
        Http::fake([
            'www.cbr.ru/scripts/XML_daily.asp' => Http::response('Server Error', 500)
        ]);

        $response = $this->get('/api/currency-rates');

        $response->assertStatus(503);
    }


    public function testCurrencyRateFetchWithRetry()
    {
        Http::fakeSequence()
            ->push('Service Unavailable', 503)
            ->push($this->mockSuccessfulResponse(), 200);

        $response = $this->get('/api/currency-rates');

        $response->assertStatus(200);
    }

    private function mockSuccessfulResponse(): bool|string
    {
        return file_get_contents(base_path('tests/Fixtures/successful_response.xml'));
    }
}


