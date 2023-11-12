<template>
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
    props: ['currencies', 'conversionResult'],
    data() {
      return {
        fromCurrency: '',
        toCurrency: '',
        amount: null,
      };
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
  }
  
  .input-group, .select-group {
    margin-bottom: 1rem;
  }
  
  input, select, button {
    width: 100%;
    padding: 0.5rem;
    margin-top: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 4px;
  }
  
  button {
    background-color: #0056b3;
    color: white;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #004494;
  }

  .conversion-result {
    margin-top: 1rem;
    text-align: center;
  }
  </style>  