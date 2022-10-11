<?php

namespace Dunice\RefactorTest;

use Symfony\Component\Dotenv\Dotenv;

class Config
{
    private array $config;

    function __construct()
    {
        $envPath = dirname(__DIR__) . '/.env';

        if (file_exists($envPath)) {
            $dotenv = new Dotenv();
            $dotenv->loadEnv($envPath);
        }

        $this->config = $_ENV;
    }

    public function getConfig(): array
    {
        return [
            'bin_list_api_url' => $this->config['BIN_LIST_API_URL'] ?? 'https://lookup.binlist.net/',
            'rates_api_url' => $this->config['RATES_API_URL'] ?? 'https://api.exchangerate.host/latest',
            'eu_rate' => $this->config['EU_RATE'] ?? 0.01,
            'not_eu_rate' => $this->config['NOT_EU_RATE'] ?? 0.02,
        ];
    }
}
