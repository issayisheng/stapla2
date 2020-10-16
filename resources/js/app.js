/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import store from "./store";
import router from "./router";


// 未認証はログインページにリダイレクト
axios.interceptors.response.use(
    response => { 
        return response;
    }, error => {
    if (error.response.status === 401) {
        router.push({ path: '/login' }).catch((error)=>{
            error;
        })
    }
    return Promise.reject(error)
})



window.Vue = require("vue");
Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("app-component", require("./components/App.vue").default);
Vue.component(
    "login-header-component",
    require("./components/LoginHeader.vue").default
);

Vue.component("app-header", require("./components/AppHeader.vue").default);
Vue.component("app-footer", require("./components/AppFooter.vue").default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require("./subscriber");
store.dispatch("auth/attempt", localStorage.getItem("token")).then();

const app = new Vue({
    router,
    store
}).$mount("#app");
