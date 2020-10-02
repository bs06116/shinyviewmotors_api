import Vue from 'vue'
import 'es6-promise/auto'
import axios from 'axios'
import './bootstrap'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
//import Login from './Login'
//import Index from './pages/Login'

import auth from './auth'
import router from './router'

// Set Vue globally
window.Vue = Vue

// Set Vue router
Vue.router = router
Vue.use(VueRouter)

// Set Vue authentication
Vue.use(VueAxios, axios)
console.log(process.env.MIX_VAR);
console.info(process.env.MIX_APP_URL)
axios.defaults.baseURL = `/api/v1`
Vue.use(VueAuth, auth)

// Load Index
//Vue.component('main-index', Index)
//Vue.component('index', require('Index').default);
//Vue.component('main-index', require('./Index'));

//Vue.component('login', require('./Login.vue'));

new Vue({
    router,
}).$mount("#app");


