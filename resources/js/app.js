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

// vuetifyの設定
// import Vuetify from "vuetify";
// import "vuetify/dist/vuetify.min.css";

window.Vue = require("vue");

Vue.use(VueRouter);
// Vue.use(Vuetify);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component(
//     "passport-clients",
//     require("./components/passport/Clients.vue").default
// );

// Vue.component(
//     "passport-authorized-clients",
//     require("./components/passport/AuthorizedClients.vue").default
// );

// Vue.component(
//     "passport-personal-access-tokens",
//     require("./components/passport/PersonalAccessTokens.vue").default
// );

Vue.component("top-component", require("./components/Top.vue").default);
Vue.component("privacy-component", require("./components/Privacy.vue").default);
Vue.component("terms-component", require("./components/Terms.vue").default);
Vue.component(
    "calendar-component",
    require("./components/Calendar.vue").default
);

Vue.component(
    "userinfo-component",
    require("./components/UserInfo.vue").default
);
Vue.component(
    "userinfo-edit-component",
    require("./components/UserInfoEdit.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router: router,
    store
    // vuetify: new Vuetify()
});
