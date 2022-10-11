<?php

namespace Dunice\RefactorTest;

class Countries
{
    const EU_COUNTRIES = [
        'AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK',
        'EE', 'FI', 'FR', 'GR', 'HR', 'HU', 'IE',
        'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PO',
        'PT', 'РО', 'SE', 'SI', 'SK',
    ];

    static function isEU(string $countryCode): bool
    {
        return (in_array($countryCode, self::EU_COUNTRIES));
    }
}
