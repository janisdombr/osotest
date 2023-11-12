<?php
/*
* Currency_model
 */
class Currency_model extends CI_Model {
    /* API URL and API Key 
    *  Based on https://www.currencyconverterapi.com/docs
    * If you're using the Free servers, use:
    * https://free.currconv.com
    * List of currencies
    * /api/v7/currencies?apiKey=[YOUR_API_KEY]
    * Convert currencies
    * /api/v7/convert?q=USD_PHP,PHP_USD&compact=ultra&apiKey=[YOUR_API_KEY]
    * Sample output:
        {
        "USD_PHP": 46.211,
        "PHP_USD": 0.02163987
        }
    */
    protected $apiUrl = 'https://free.currconv.com';
    protected $apiKey = '0a5568ec30cdf9eec852';
    public function __construct() {
        parent::__construct();
    }
    /* Get the list of currencies from the API
    *  and return it as an array
    * If the list is already cached, return the cached version
    * Otherwise, get the list from the API and cache it
    * for 24 hours
    * @return array
    * with the following structure:
    * [
    *   {
    *     "id": "AED",
    *     "currencyName": "United Arab Emirates Dirham",
    *     "currencySymbol": "د.إ"
    *   },
    *   { ... } 
    * ]
    */
    public function get_currency_list() {
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $currencies = $this->cache->get('currencies');
        if (!$currencies) {
            $currencies = array();
            $url = $this->apiUrl . '/api/v7/currencies?apiKey=' . $this->apiKey;
            try {
                $response = @file_get_contents($url);
                if ($response === FALSE) {
                    // Handle error
                    $error = error_get_last();
                    throw new Exception('Error getting currency list: ' . $error['message']);
                }

                $response = json_decode($response, true);
                // Process and return the response
                foreach ($response['results'] as $key => $value) {
                    $currency = array(
                        'id' => $key);
                    foreach ($value as $k => $v) {
                        $currency[$k] = $v;
                    }
                    $currencies[] = $currency;
                }
                $this->cache->save('currencies', $currencies, 86400);
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                // Return an error message or code
                return NULL;
            }
        }
        return $currencies;
    }
    /* Convert a currency
    *  @param string $from
    *  @param string $to
    *  @param float $amount
    *  @return array
    *  with the following structure:
    *  [
    *    'from' => 'USD',
    *    'to' => 'PHP',
    *    'amount' => 100,
    *    'convertedAmount' => 4621.1,
    *    'rate' => 46.211,
    *    'inverseRate' => 0.02163987
    *  ]
    */
    public function convert_currency($from, $to, $amount) {
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $conversionKey = $from . '_' . $to;
        $inverseKey = $to . '_' . $from;
    
        $result = $this->cache->get($conversionKey);
        $inverseResult = $this->cache->get($inverseKey);
    
        if (!$result || !$inverseResult) {
            $url = $this->apiUrl . '/api/v7/convert?q=' . $conversionKey . ',' . $inverseKey . '&compact=ultra&apiKey=' . $this->apiKey;
            try {
                $response = @file_get_contents($url);
                if ($response === FALSE) {
                    // Handle error
                    $error = error_get_last();
                    throw new Exception('Error converting currency: ' . $error['message']);
                }
                $response = json_decode($response, true);
                $result = $response[$conversionKey];
                $inverseResult = $response[$inverseKey];
                // Save both results in the cache
                $this->cache->save($conversionKey, $result, 86400);
                $this->cache->save($inverseKey, $inverseResult, 86400);
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                // Return an error message or code
                return NULL;
            }
        }
        
        // Construct and return the detailed result
        return [
            'from' => $from,
            'to' => $to,
            'amount' => $amount,
            'convertedAmount' => $result * $amount,
            'rate' => $result,
            'inverseRate' => $inverseResult
        ];
    }
    /* Get the exchange rate for a given currency pair
    *  @param string $conversionKey
    *  @return float|null
    */
    public function get_rate($conversionKey) {
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        
        $rate = $this->cache->get($conversionKey);
        
        if (!$rate) {
            $url = $this->apiUrl . '/api/v7/convert?q=' . $conversionKey . '&compact=ultra&apiKey=' . $this->apiKey;
            try {
                $response = @file_get_contents($url);
                if ($response === FALSE) {
                    // Handle error
                    $error = error_get_last();
                    throw new Exception('Error getting rate: ' . $error['message']);
                }
                $response = json_decode($response, true);
                $rate = $response[$conversionKey];
                // Save the result in the cache
                $this->cache->save($conversionKey, $rate, 86400);
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                return NULL;
            }
        }

        return $rate;
    }
}

?>