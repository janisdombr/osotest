<?php
use PHPUnit\Framework\TestCase;
/**
 * @covers Api
 * @uses   Api
 * @covers Api::get_currencies
 * @uses   Api::get_currencies
 * @covers Api::convert_currency
 * @uses   Api::convert_currency
 */
class ApiControllerTest extends TestCase {
    protected $CI;
    protected $controller;

    protected function setUp(): void {
        // Bootstrap the CodeIgniter framework
        $this->CI =& get_instance();

        // Load the controller
        $this->CI->load->controller('api');
        $this->controller = $this->CI->api;
    }

    public function testGetCurrencies() {
        // Simulate calling the /api/get_currencies endpoint
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $this->controller->get_currencies();

        // Access the output
        $output = $this->CI->output->get_output();
        
        // Decode the JSON response
        $decodedOutput = json_decode($output, true);
        
        // Make assertions
        $this->assertIsArray($decodedOutput);
        // Add more assertions based on the expected structure of the response
        $this->assertArrayHasKey('id', $decodedOutput[0]);
        $this->assertArrayHasKey('currencyName', $decodedOutput[0]);
        $this->assertArrayHasKey('currencySymbol', $decodedOutput[0]);
    }

    public function testConvertCurrency() {
        // Simulate calling the /api/convert_currency endpoint with query parameters
        $_GET['from'] = 'USD';
        $_GET['to'] = 'EUR';
        $_GET['amount'] = 100;
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $this->controller->convert_currency();

        // Access the output
        $output = $this->CI->output->get_output();
        
        // Decode the JSON response
        $decodedOutput = json_decode($output, true);
        
        // Make assertions
        $this->assertIsArray($decodedOutput);
        // Continue with assertions specific to the expected response
        $this->assertArrayHasKey('convertedAmount', $decodedOutput);
        $this->assertArrayHasKey('rate', $decodedOutput);
        $this->assertArrayHasKey('inverseRate', $decodedOutput);
        $this->assertArrayHasKey('from', $decodedOutput);
        $this->assertArrayHasKey('to', $decodedOutput);
        $this->assertArrayHasKey('amount', $decodedOutput);
    }
}
?>