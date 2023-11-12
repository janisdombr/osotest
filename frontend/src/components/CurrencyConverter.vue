<template>
    <div class="currency-rates">
      <h3>Current Rates to USD for today:</h3>
      <ul>
        <li v-for="(rate, currency) in rates" :key="currency">
          1 USD = {{ rate }} {{ currency }}
        </li>
      </ul>
    </div>
    <div class="currency-converter">
      <form @submit.prevent="onConvert">
        <div class="select-group">
          <select v-model="fromCurrency">
            <option v-for="currency in currencies" :key="currency.id" :value="currency.id">
              {{ currency.currencySymbol }} - {{ currency.currencyName }}
            </option>
          </select>
          <select v-model="toCurrency">
            <option v-for="currency in currencies" :key="currency.id" :value="currency.id">
              {{ currency.currencySymbol }} - {{ currency.currencyName }}
            </option>
          </select>
        </div>
        <div class="input-group">
          <input type="number" v-model="amount" placeholder="Amount" />
          <button type="submit">Convert</button>
        </div>
      </form>
      <div v-if="conversionResult" class="conversion-result">
        <p>{{ conversionResult.amount }} {{ conversionResult.from }} equals</p>
        <h2>{{ conversionResult.convertedAmount }} {{ conversionResult.to }}</h2>
        <p>1 {{ conversionResult.from }} = {{ conversionResult.rate }} {{ conversionResult.to }}</p>
        <p>1 {{ conversionResult.to }} = {{ conversionResult.inverseRate }} {{ conversionResult.from }}</p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'CurrencyConverter',
    props: ['currencies', 'conversionResult', 'rates'],
    data() {
      return {
        fromCurrency: 'USD',
        toCurrency: 'EUR',
        amount: 100,
      };
    },
    mounted() {
      this.onConvert(); // Call onConvert to perform default conversion on mount
    },
    methods: {
      onConvert() {
        // Emit an event for the parent component to handle conversion
        this.$emit('convert', this.fromCurrency, this.toCurrency, this.amount);
      }
    }
  };
  </script>
  
  <style>
  .currency-converter {
    display: flex;
    flex-direction: column;
    max-width: 300px;
    margin: auto;
    padding: 2rem;
    background: white;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border-radius: 8px;
  }

  .input-group, .select-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 1rem;
  }

  input, select {
    width: 100%;
    padding: 10px;
    margin-top: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
  }

  button {
    padding: 10px;
    border: none;
    border-radius: 4px;
    background-color: #0056b3;
    color: white;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  button:hover {
    background-color: #004494;
  }

  .conversion-result {
    text-align: center;
    padding-top: 1rem;
  }

  .rates-container {
    background: #f7f7f7;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 2rem;
  }

  .rates-container h2 {
    color: #333;
    font-size: 1.2rem;
    margin-bottom: .5rem;
  }

  ul {
    list-style: none;
    padding: 0;
  }

  li {
    margin-bottom: .5rem;
    font-size: .9rem;
  }
  </style>  