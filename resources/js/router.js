import Vue from "vue";
import VueRouter from "vue-router";

// VueRouterプラグインを使用する
Vue.use(VueRouter);

// コンポーネントをインポート
import Home from "./views/Home.vue";
import Home2 from "./components/Home.vue";

export default new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/about",
            name: "about",
            component: Home2
        }
    ]
});