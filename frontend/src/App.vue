<template>
  <div id="app">
    <h1>Currency Converter</h1>
    <currency-converter @convert="performConversion" :currencies="currencies" :conversionResult="conversion" />
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
      conversion: []
      // other data properties
    };
  },
  methods: {
    performConversion(fromCurrency, toCurrency, amount) {
    //  npm install axios
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
    axios.get('/api/get_currencies')
    .then(response => {
      // Assuming the response is an array of currencies
      this.currencies = response.data;
    })
    .catch(error => {
      console.error('Error fetching currencies:', error);
    });
  }
  },
  mounted() {
    this.fetchCurrencies();
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
</style>