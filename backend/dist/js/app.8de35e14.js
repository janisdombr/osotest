(function(){"use strict";var e={4779:function(e,n,r){var o=r(9242),t=r(3396);const i={id:"app"},u=(0,t._)("h1",null,"Currency Converter",-1),c={key:0};function s(e,n,r,o,s,l){const a=(0,t.up)("currency-converter");return(0,t.wg)(),(0,t.iD)("div",i,[u,s.isLoading?((0,t.wg)(),(0,t.iD)("div",c,"Loading...")):((0,t.wg)(),(0,t.j4)(a,{key:1,onConvert:l.performConversion,currencies:s.currencies,conversionResult:s.conversion,rates:s.topRates},null,8,["onConvert","currencies","conversionResult","rates"]))])}var l=r(7139);const a={class:"currency-rates"},v=(0,t._)("h3",null,"Current Rates to USD for today:",-1),f={class:"currency-converter"},d={class:"select-group"},p=["value"],h=["value"],m={class:"input-group"},y=(0,t._)("button",{type:"submit"},"Convert",-1),g={key:0,class:"conversion-result"};function w(e,n,r,i,u,c){return(0,t.wg)(),(0,t.iD)(t.HY,null,[(0,t._)("div",a,[v,(0,t._)("ul",null,[((0,t.wg)(!0),(0,t.iD)(t.HY,null,(0,t.Ko)(r.rates,((e,n)=>((0,t.wg)(),(0,t.iD)("li",{key:n}," 1 USD = "+(0,l.zw)(e)+" "+(0,l.zw)(n),1)))),128))])]),(0,t._)("div",f,[(0,t._)("form",{onSubmit:n[3]||(n[3]=(0,o.iM)(((...e)=>c.onConvert&&c.onConvert(...e)),["prevent"]))},[(0,t._)("div",d,[(0,t.wy)((0,t._)("select",{"onUpdate:modelValue":n[0]||(n[0]=e=>u.fromCurrency=e)},[((0,t.wg)(!0),(0,t.iD)(t.HY,null,(0,t.Ko)(r.currencies,(e=>((0,t.wg)(),(0,t.iD)("option",{key:e.id,value:e.id},(0,l.zw)(e.currencySymbol)+" - "+(0,l.zw)(e.currencyName),9,p)))),128))],512),[[o.bM,u.fromCurrency]]),(0,t.wy)((0,t._)("select",{"onUpdate:modelValue":n[1]||(n[1]=e=>u.toCurrency=e)},[((0,t.wg)(!0),(0,t.iD)(t.HY,null,(0,t.Ko)(r.currencies,(e=>((0,t.wg)(),(0,t.iD)("option",{key:e.id,value:e.id},(0,l.zw)(e.currencySymbol)+" - "+(0,l.zw)(e.currencyName),9,h)))),128))],512),[[o.bM,u.toCurrency]])]),(0,t._)("div",m,[(0,t.wy)((0,t._)("input",{type:"number","onUpdate:modelValue":n[2]||(n[2]=e=>u.amount=e),placeholder:"Amount"},null,512),[[o.nr,u.amount]]),y])],32),r.conversionResult?((0,t.wg)(),(0,t.iD)("div",g,[(0,t._)("p",null,(0,l.zw)(r.conversionResult.amount)+" "+(0,l.zw)(r.conversionResult.from)+" equals",1),(0,t._)("h2",null,(0,l.zw)(r.conversionResult.convertedAmount)+" "+(0,l.zw)(r.conversionResult.to),1),(0,t._)("p",null,"1 "+(0,l.zw)(r.conversionResult.from)+" = "+(0,l.zw)(r.conversionResult.rate)+" "+(0,l.zw)(r.conversionResult.to),1),(0,t._)("p",null,"1 "+(0,l.zw)(r.conversionResult.to)+" = "+(0,l.zw)(r.conversionResult.inverseRate)+" "+(0,l.zw)(r.conversionResult.from),1)])):(0,t.kq)("",!0)])],64)}var C={name:"CurrencyConverter",props:["currencies","conversionResult","rates"],data(){return{fromCurrency:"USD",toCurrency:"EUR",amount:100}},mounted(){this.onConvert()},methods:{onConvert(){this.$emit("convert",this.fromCurrency,this.toCurrency,this.amount)}}},b=r(89);const R=(0,b.Z)(C,[["render",w]]);var _=R,z=r(1076),D={name:"App",components:{CurrencyConverter:_},data(){return{currencies:[],conversion:[],topRates:{EUR:null,GBP:null,JPY:null,CNY:null},isLoading:!0}},methods:{performConversion(e,n,r){if(!this.currencies.length)return console.error("Currencies not loaded yet"),void setTimeout((()=>{this.performConversion(e,n,r)}),1e3);e&&n&&r?z.Z.get("/api/convert_currency",{params:{from:e,to:n,amount:r}}).then((e=>{console.log(e.data),this.conversion=e.data})).catch((e=>{console.error("Conversion error:",e)})):console.error("Missing required parameters")},fetchCurrencies(){this.isLoading=!0,z.Z.get("/api/get_currencies").then((e=>{console.log("Currencies:",this.currencies),this.currencies=e.data,this.isLoading=!1})).catch((e=>{console.error("Error fetching currencies:",e),this.isLoading=!1}))},fetchTopRates(){z.Z.get("/api/top_rates_to_usd").then((e=>{for(let n in e.data)this.topRates[n]=e.data[n],console.log(n,e.data[n]);console.log("TopRates:"),console.log(this.topRates)})).catch((e=>{console.error("Error fetching top rates:",e)}))}},mounted(){this.fetchCurrencies(),this.fetchTopRates(),this.performConversion(this.fromCurrency,this.toCurrency,this.amount)}};const O=(0,b.Z)(D,[["render",s]]);var k=O;(0,o.ri)(k).mount("#app")}},n={};function r(o){var t=n[o];if(void 0!==t)return t.exports;var i=n[o]={exports:{}};return e[o].call(i.exports,i,i.exports,r),i.exports}r.m=e,function(){var e=[];r.O=function(n,o,t,i){if(!o){var u=1/0;for(a=0;a<e.length;a++){o=e[a][0],t=e[a][1],i=e[a][2];for(var c=!0,s=0;s<o.length;s++)(!1&i||u>=i)&&Object.keys(r.O).every((function(e){return r.O[e](o[s])}))?o.splice(s--,1):(c=!1,i<u&&(u=i));if(c){e.splice(a--,1);var l=t();void 0!==l&&(n=l)}}return n}i=i||0;for(var a=e.length;a>0&&e[a-1][2]>i;a--)e[a]=e[a-1];e[a]=[o,t,i]}}(),function(){r.n=function(e){var n=e&&e.__esModule?function(){return e["default"]}:function(){return e};return r.d(n,{a:n}),n}}(),function(){r.d=function(e,n){for(var o in n)r.o(n,o)&&!r.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:n[o]})}}(),function(){r.g=function(){if("object"===typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"===typeof window)return window}}()}(),function(){r.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)}}(),function(){r.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}}(),function(){var e={143:0};r.O.j=function(n){return 0===e[n]};var n=function(n,o){var t,i,u=o[0],c=o[1],s=o[2],l=0;if(u.some((function(n){return 0!==e[n]}))){for(t in c)r.o(c,t)&&(r.m[t]=c[t]);if(s)var a=s(r)}for(n&&n(o);l<u.length;l++)i=u[l],r.o(e,i)&&e[i]&&e[i][0](),e[i]=0;return r.O(a)},o=self["webpackChunkfrontend"]=self["webpackChunkfrontend"]||[];o.forEach(n.bind(null,0)),o.push=n.bind(null,o.push.bind(o))}();var o=r.O(void 0,[998],(function(){return r(4779)}));o=r.O(o)})();
//# sourceMappingURL=app.8de35e14.js.map