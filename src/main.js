import Vue from 'vue'
import App from './App.vue'

import BootstrapVue from "bootstrap-vue"

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
window.Vue = require('vue');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

Vue.use(BootstrapVue)


new Vue({
  el: '#app',
  render: h => h(App)
})
