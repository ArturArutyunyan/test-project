<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Dunice\RefactorTest\Calculator;
use Dunice\RefactorTest\Countries;

final class CalculatorTest extends TestCase
{
    public function testCountryIsEU(): void
    {
        $this->assertTrue(Countries::isEU('DE'));
    }

    public function testCountryIsNotEU(): void
    {
        $this->assertFalse(Countries::isEU('US'));
    }

    public function testGetRatesForCurrency(): void
    {
        $this->assertIsFloat((new Calculator)->getRates('EUR'));
    }

    public function testGetCountryDataByBIN(): void
    {
        $this->assertIsString((new Calculator)->getCountryData(45717360)->country->name);
    }

    public function testRoundUp(): void
    {
        $this->assertEquals(0.22, (new Calculator)->roundUp(0.215776432));
    }
}
