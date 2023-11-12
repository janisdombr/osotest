<?php
use PHPUnit\Framework\TestCase;

/**
 * @covers Currency_model
 * @uses   Currency_model
 * @covers Currency_model::get_currency_list
 * @uses   Currency_model::get_currency_list
 * @covers Currency_model::convert_currency
 * @uses   Currency_model::convert_currency
 */
class CurrencyModelTest extends TestCase {
    protected $currencyModel;

    protected function setUp(): void {
        $this->CI =& get_instance();
        $this->CI->load->model('currency_model');
        $this->currencyModel = $this->CI->currency_model;
    }

    public function testGetCurrencyList() {
        $result = $this->currencyModel->get_currency_list();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('id', $result[0]);
        $this->assertArrayHasKey('currencyName', $result[0]);
        $this->assertArrayHasKey('currencySymbol', $result[0]);
        // Additional assertions based on expected result
    }

    public function testConvertCurrency() {
        $result = $this->currencyModel->convert_currency('USD', 'EUR', 100);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('from', $result);
        $this->assertArrayHasKey('to', $result);
        $this->assertArrayHasKey('amount', $result);
        $this->assertArrayHasKey('convertedAmount', $result);
        $this->assertArrayHasKey('rate', $result);
        $this->assertArrayHasKey('inverseRate', $result);
        // Additional assertions based on expected result
    }
    public function testGetRate() {
        // Assuming USD_EUR is a valid conversion key and there's a rate available
        $conversionKey = 'USD_EUR';
        $rate = $this->currencyModel->get_rate($conversionKey);
        
        $this->assertNotNull($rate);
        $this->assertIsFloat($rate);
        // If you know the expected rate, you can also assert for the specific value
        // $this->assertEquals(0.85, $rate);
    }
}
?>