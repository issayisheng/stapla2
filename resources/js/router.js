import Vue from "vue";
import VueRouter from "vue-router";

// VueRouterプラグインを使用する
Vue.use(VueRouter);

// コンポーネントをインポート
import UserInfo from "./components/UserInfo.vue";
import UserInfoEdit from "./components/UserInfoEdit.vue";

export default new VueRouter({
    mode: "history",
    routes: [
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
