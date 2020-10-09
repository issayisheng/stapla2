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
import VerifyEmail from "./components/VerifyEmail.vue";
import ForgotPassword from "./components/ForgotPassword.vue";
import PasswordReset from "./components/PasswordReset.vue";
import Privacy from "./components/common/Privacy.vue";
import Terms from "./components/common/Terms.vue";
import Dashboard from "./components/Dashborad.vue";

import Reserve from "./components/Reserve.vue";
import ReserveShow from "./components/ReserveShow.vue";
import ReserveSuccess from "./components/ReserveSuccess.vue";
import ReserveFailed from "./components/ReserveFailed.vue";

import UserInfo from "./components/settings/userinfo/UserInfo.vue";
import UserInfoEdit from "./components/settings/userinfo/UserInfoEdit.vue";
import Password from "./components/settings/userinfo/Password.vue";
import PasswordEdit from "./components/settings/userinfo/PasswordEdit.vue";

import GymInfo from "./components/settings/gym/GymInfo.vue";
import GymInfoCreate from "./components/settings/gym/GymInfoCreate.vue";
import GymInfoEdit from "./components/settings/gym/GymInfoEdit.vue";
import GymInfoShow from "./components/settings/gym/GymInfoShow.vue";

import Trainer from "./components/settings/trainer/Trainer.vue";
import TrainerEdit from "./components/settings/trainer/TrainerEdit.vue";

import History from "./components/settings/history/History.vue";
import HistoryShow from "./components/settings/history/HistoryShow.vue";

import Ticket from "./components/settings/ticket/Ticket.vue";
import TicketCancel from "./components/settings/ticket/Cancel.vue";
import TicketSuccess from "./components/settings/ticket/Success.vue";

import Reservation from "./components/settings/reservation/Reservation.vue";
import ReservationShow from "./components/settings/reservation/ReservationShow.vue";

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
                    path: "/verifyemail",
                    name: "verifyemail",
                    component: VerifyEmail
                },
                {
                    path: "/password/email",
                    name: "forgotpassword",
                    component: ForgotPassword
                },
                {
                    path: "/password/reset/:id",
                    name: "password_reset",
                    component: PasswordReset
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
                    path: "/reserve",
                    name: "reserve",
                    component: Reserve
                },
                {
                    path: "/reserve/:id",
                    name: "reserve_show",
                    component: ReserveShow
                },
                {
                    path: "/reserve/success/:id",
                    name: "reserve_success",
                    component: ReserveSuccess
                },
                {
                    path: "/reserve/failed/:id",
                    name: "reserve_failed",
                    component: ReserveFailed
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
                    path: "/settings/gym_info/:id",
                    name: "gyminfo_show",
                    component: GymInfoShow
                },
                {
                    path: "/settings/gym_info/:id/edit",
                    name: "gyminfo_edit",
                    component: GymInfoEdit
                },
                {
                    path: "/settings/trainer",
                    name: "trainer",
                    component: Trainer
                },
                {
                    path: "/settings/trainer/:id/edit",
                    name: "trainer_edit",
                    component: TrainerEdit
                },
                {
                    path: "/settings/reservation",
                    name: "reservation",
                    component: Reservation
                },
                {
                    path: "/settings/reservation/:id",
                    name: "reservation_show",
                    component: ReservationShow
                },
                {
                    path: "/settings/history",
                    name: "history",
                    component: History
                },
                {
                    path: "/settings/history/:id",
                    name: "history_show",
                    component: HistoryShow
                },
                {
                    path: "/settings/ticket",
                    name: "ticket",
                    component: Ticket
                },
                {
                    path: "/settings/ticket/cancel",
                    name: "ticket_cancel",
                    component: TicketCancel
                },
                {
                    path: "/settings/ticket/success",
                    name: "ticket_success",
                    component: TicketSuccess
                }
            ]
        },
        {
            path: "*",
            component: NotFound // 404
        }
    ],
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            //全てのルートナビゲーションに対してページスクロールをトップ
            return { x: 0, y: 0 };
        }
    }
});
