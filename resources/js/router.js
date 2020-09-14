import Vue from "vue";
import VueRouter from "vue-router";

// VueRouterプラグインを使用する
Vue.use(VueRouter);

// コンポーネントをインポート
import Top from "./components/Top.vue";
import Login from "./components/Login.vue";
import Privacy from "./components/Privacy.vue";
import Terms from "./components/Terms.vue";
import UserInfo from "./components/UserInfo.vue";
import UserInfoEdit from "./components/UserInfoEdit.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "top",
            component: Top
        },
        {
            path: "/login",
            name: "login",
            component: Login
        },
        {
            path: "/privacy",
            name: "privacy",
            component: Privacy
        },
        {
            path: "/terms",
            name: "terms",
            component: Terms
        },
        {
            path: "/user_info",
            name: "userinfo",
            component: UserInfo
        },
        {
            path: "/user_info/:id/edit",
            name: "userinfo_edit",
            component: UserInfoEdit
        }
    ]
});
export default router;
