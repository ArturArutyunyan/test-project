<?php

namespace Dunice\RefactorTest;

use GuzzleHttp\Client;

class Calculator
{
    public Client $client;
    private array $config;

    function __construct()
    {
        $this->config = (new Config())->getConfig();
        $this->client = new Client();
    }

    public function getCountryData($bin)
    {
        $response = $this->client->request('GET', $this->config['bin_list_api_url'] . $bin);
        return json_decode($response->getBody()->getContents());
    }

    public function getRates($currency): float
    {
        $response = $this->client->request('GET', $this->config['rates_api_url']);
        $responseData = json_decode($response->getBody()->getContents());
        return $responseData->rates->$currency;
    }

    public function showCommission($amount, $rate, $currency, $isEu): float
    {
        if ($currency === 'EUR' || $rate === 0) {
            $commission = $amount;
        } else {
            $commission = $amount / $rate;
        }

        return $isEu ? $commission * $this->config['eu_rate'] : $commission * $this->config['not_eu_rate'];
    }

    public function roundUp($number, $precision = 2): float
    {
        $fig = pow(10, $precision);
        return (ceil($number * $fig) / $fig);
    }

    public function calculate($file): void
    {
        foreach (explode("\n", $file) as $row) {
            $encodedRow = json_decode($row);
            $currency = $encodedRow->currency;

            $countryData = $this->getCountryData($encodedRow->bin);
            $countryCode = ($countryData->country->alpha2);

            $rate = $this->getRates($currency);
            $isEu = Countries::isEU($countryCode);
            $commission = $this->roundUp($this->showCommission($encodedRow->amount, $rate, $currency, $isEu));

            echo "$commission \r\n";
        }
    }
}
