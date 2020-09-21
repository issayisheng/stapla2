import Vue from "vue";
import VueRouter from "vue-router";

// VueRouterプラグインを使用する
Vue.use(VueRouter);

// コンポーネントをインポート
import MainLayout from "./components/layouts/MainLayout.vue";
import LoginLayout from "./components/layouts/LoginLayout.vue";
import Top from "./components/Top.vue";
import Login from "./components/Login.vue";
import Register from "./components/Register.vue";
import Privacy from "./components/common/Privacy.vue";
import Terms from "./components/common/Terms.vue";
import Dashboard from "./components/Dashborad.vue";
import Gym from "./components/Gym.vue";
import GymShow from "./components/GymShow.vue";
import UserInfo from "./components/settings/userinfo/UserInfo.vue";
import UserInfoEdit from "./components/settings/userinfo/UserInfoEdit.vue";
import Password from "./components/settings/userinfo/Password.vue";
import PasswordEdit from "./components/settings/userinfo/PasswordEdit.vue";
import GymInfo from "./components/settings/gym/GymInfo.vue";
import GymInfoCreate from "./components/settings/gym/GymInfoCreate.vue";
import GymInfoEdit from "./components/settings/gym/GymInfoEdit.vue";
import GymInfoShow from "./components/settings/gym/GymInfoShow.vue";
import Trainer from "./components/settings/trainer/Trainer.vue";
import History from "./components/settings/history/History.vue";
import Ticket from "./components/settings/ticket/Ticket.vue";
import Reserved from "./components/settings/reserved/Reserved.vue";
import NotFound from "./components/NotFound.vue";

// vue-routerによるルーティング設定
export default new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            redirect: { name: "top" }, // topにリダイレクト
            component: LoginLayout, // login前レイアウト
            children: [
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
                    path: "/register",
                    name: "register",
                    component: Register
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
                }
            ]
        },
        {
            path: "/dashboard",
            component: MainLayout, // login後レイアウト
            children: [
                {
                    path: "/dashboard",
                    name: "dashboard",
                    component: Dashboard
                },
                {
                    path: "/gym",
                    name: "gym",
                    component: Gym
                },
                {
                    path: "/gym/:id",
                    name: "gym_show",
                    component: GymShow
                },
                {
                    path: "/settings/user_info",
                    name: "userinfo",
                    component: UserInfo
                },
                {
                    path: "/settings/user_info/:id/edit",
                    name: "userinfo_edit",
                    component: UserInfoEdit
                },
                {
                    path: "/settings/user_info/password",
                    name: "password",
                    component: Password
                },
                {
                    path: "/settings/user_info/password/:id/edit",
                    name: "password_edit",
                    component: PasswordEdit
                },
                {
                    path: "/settings/gym_info",
                    name: "gyminfo",
                    component: GymInfo
                },
                {
                    path: "/settings/gym_info/create",
                    name: "gyminfo_create",
                    component: GymInfoCreate
                },
                {
                    path: "/settings/gym_info/:id/edit",
                    name: "gyminfo_edit",
                    component: GymInfoEdit
                },
                {
                    path: "/settings/gym_info/:id",
                    name: "gyminfo_show",
                    component: GymInfoShow
                },
                {
                    path: "/settings/trainer",
                    name: "trainer",
                    component: Trainer
                },
                {
                    path: "/settings/reserved",
                    name: "reserved",
                    component: Reserved
                },
                {
                    path: "/settings/history",
                    name: "history",
                    component: History
                },
                {
                    path: "/settings/ticket",
                    name: "ticket",
                    component: Ticket
                }
            ]
        },
        {
            path: "*",
            component: NotFound // 404
        }
    ]
});
