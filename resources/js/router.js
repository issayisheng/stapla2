import Vue from "vue";
import VueRouter from "vue-router";

// VueRouterプラグインを使用する
Vue.use(VueRouter);

// Layout
import MainLayout from "./components/layouts/MainLayout.vue";
import LoginLayout from "./components/layouts/LoginLayout.vue";

import Top from "./views/Top.vue";
import Dashboard from "./views/Dashborad.vue";

// common
import About from "./views/common/About.vue";
import Faq from "./views/common/Faq.vue";
import Company from "./views/common/Company.vue";
import Contact from "./views/common/Contact.vue";
import Law from "./views/common/Law.vue";
import Privacy from "./views/common/Privacy.vue";
import Terms from "./views/common/Terms.vue";

// Auth
import Login from "./views/Auth/Login.vue";
import Register from "./views/Auth/Register.vue";
import RegisterEmail from "./views/Auth/RegisterEmail.vue";
import VerifyEmail from "./views/Auth/VerifyEmail.vue";
import ForgotPassword from "./views/Auth/ForgotPassword.vue";
import PasswordReset from "./views/Auth/PasswordReset.vue";

// Reserve
import Reserve from "./views/reserve/Reserve.vue";
import ReserveShow from "./views/reserve/ReserveShow.vue";
import ReserveSuccess from "./views/reserve/ReserveSuccess.vue";
import ReserveFailed from "./views/reserve/ReserveFailed.vue";

// user
import UserInfo from "./views/settings/userinfo/UserInfo.vue";
import UserInfoEdit from "./views/settings/userinfo/UserInfoEdit.vue";
import Password from "./views/settings/userinfo/Password.vue";
import PasswordEdit from "./views/settings/userinfo/PasswordEdit.vue";

// Gym
import GymInfo from "./views/settings/gym/GymInfo.vue";
import GymInfoCreate from "./views/settings/gym/GymInfoCreate.vue";
import GymInfoEdit from "./views/settings/gym/GymInfoEdit.vue";
import GymInfoShow from "./views/settings/gym/GymInfoShow.vue";

// Trainer
import Trainer from "./views/settings/trainer/Trainer.vue";
import TrainerEdit from "./views/settings/trainer/TrainerEdit.vue";

// History
import History from "./views/settings/history/History.vue";
import HistoryShow from "./views/settings/history/HistoryShow.vue";

// Ticket
import Ticket from "./views/settings/ticket/Ticket.vue";
import TicketCancel from "./views/settings/ticket/Cancel.vue";
import TicketSuccess from "./views/settings/ticket/Success.vue";


import Reservation from "./views/settings/reservation/Reservation.vue";
import ReservationShow from "./views/settings/reservation/ReservationShow.vue";

// 404
import NotFound from "./views/errors/NotFound.vue";


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
                    path: "/about",
                    name: "about",
                    component: About
                },     
                {
                    path: "/faq",
                    name: "faq",
                    component: Faq
                },    
                {
                    path: "/company",
                    name: "company",
                    component: Company
                },
                {
                    path: "/law",
                    name: "law",
                    component: Law
                },  
                {
                    path: "/contact",
                    name: "contact",
                    component: Contact
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
                    path: "/register/email",
                    name: "register/email",
                    component: RegisterEmail
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
