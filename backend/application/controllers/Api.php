<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* API Controller
*  This controller is used to provide API endpoints
*  for the Vue.js app
*/
class Api extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Currency_model');
    }
    /**
     * get_currencies
     * method used to get currency list
     * from external API via Currency_model
     */
    public function get_currencies() {
        $currencies = $this->Currency_model->get_currency_list();
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($currencies));
    }
    /**
     * convert_currency
     * method used to convert currency
     * from external API via Currency_model
     */
    public function convert_currency() {
        // Expected parameters: 'from', 'to', 'amount'
        $result = $this->Currency_model->convert_currency(
            $this->input->get('from'), 
            $this->input->get('to'), 
            $this->input->get('amount')
        );
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($result));
    }
    /**
     * top_rates_to_usd
     * method used to get currency list
     * from external API via Currency_model
     */
    public function top_rates_to_usd() {
        $topCurrencies = ['EUR', 'GBP', 'JPY', 'CNY'];
        $rates = [];
        foreach ($topCurrencies as $currency) {
            $conversionKey = $currency . '_USD';
            $rate = $this->Currency_model->get_rate($conversionKey);
            
            if ($rate !== NULL) {
                $rates[$currency] = $rate;
            }
        }
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($rates));
    }
}

?>