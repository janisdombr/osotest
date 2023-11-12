<template>
  <div id="app">
    <h1>Currency Converter</h1>
    <div v-if="isLoading">Loading...</div>
    <template v-else>
      <currency-converter 
        @convert="performConversion" 
        :currencies="currencies" 
        :conversionResult="conversion"
        :rates="topRates" />
    </template>
  </div>
</template>

<script>
import CurrencyConverter from './components/CurrencyConverter.vue';
import axios from 'axios'

export default {
  name: 'App',
  components: {
    CurrencyConverter
  },
  data() {
    return {
      currencies: [],
      conversion: [],
      topRates: {
        'EUR': null,
        'GBP': null,
        'JPY': null,
        'CNY': null
      },
      isLoading: true
      // other data properties
    };
  },
  methods: {
    performConversion(fromCurrency, toCurrency, amount) {
      if (!this.currencies.length) {
        // If currencies haven't been loaded yet, don't perform the conversion.
        console.error('Currencies not loaded yet');
        setTimeout(() => {
          this.performConversion(fromCurrency, toCurrency, amount);
        }, 1000);
        return;
      }
      if (!fromCurrency || !toCurrency || !amount) {
        // If any of the required parameters are missing, don't perform the conversion.
        console.error('Missing required parameters');
        return;
      }
      // If rates are required for the conversion, check if they have been loaded
      // if (this.topRates[fromCurrency] === undefined || this.topRates[toCurrency] === undefined) {
      //   console.error('Rates not loaded yet');
      //   setTimeout(() => {
      //     this.performConversion(fromCurrency, toCurrency, amount);
      //   }, 1000);
      //   return;
      // }
      axios.get('/api/convert_currency', {
        params: {
          from: fromCurrency,
          to: toCurrency,
          amount: amount
        }
      })
      .then(response => {
        // Handle the response with conversion result
        console.log(response.data); // The conversion result from the server
        this.conversion = response.data;
        // You can store the result in a data property or pass it to a child component
      })
      .catch(error => {
        // Handle any errors here
        console.error('Conversion error:', error);
      });
    },
    fetchCurrencies() {
      this.isLoading = true;
      axios.get('/api/get_currencies')
      .then(response => {
        // Assuming the response is an array of currencies
        console.log('Currencies:', this.currencies);
        this.currencies = response.data;
        this.isLoading = false;
      })
      .catch(error => {
        console.error('Error fetching currencies:', error);
        this.isLoading = false;
      });
    },
    fetchTopRates() {
      axios.get('/api/top_rates_to_usd') // Replace with actual API endpoint
        .then(response => {
          // Assuming the response has the structure { 'EUR': 0.85, 'GBP': 0.75, ... }
          for (let currency in response.data) {
            this.topRates[currency] = response.data[currency];
            console.log(currency, response.data[currency]);
          }
          //this.topRates = response.data;
          console.log('TopRates:');
          console.log(this.topRates);
        })
        .catch(error => {
          console.error('Error fetching top rates:', error);
        });
    }
  },
  mounted() {
    this.fetchCurrencies();
    this.fetchTopRates();
    this.performConversion(this.fromCurrency, this.toCurrency, this.amount);
  }
};
</script>

<style>
#app {
  max-width: 600px;
  margin: 2rem auto;
  text-align: center;
}

h1 {
  color: #333;
}
.rates-container {
  margin-bottom: 2rem;
}
</style>