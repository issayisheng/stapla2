<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <router-link to="/dashboard" class="navbar-brand"
                >Stapla</router-link
            >

            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- <ul class="navbar-nav mr-auto"></ul> -->

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <template v-if="authenticated">
                        <router-link
                            to="/settings/user_info"
                            class="nav-item nav-link"
                            >マイページ</router-link
                        >
                        <router-link
                            to="/settings/reservation"
                            class="nav-item nav-link"
                            >予約状況</router-link
                        >
                        <router-link
                            to="/settings/gym_info"
                            class="nav-item nav-link"
                            >ジム管理</router-link
                        >
                        <!-- <router-link
                            v-if="user.status == 5"
                            to="/settings/trainer"
                            class="nav-item nav-link"
                            >トレーナー管理</router-link
                        > -->
                        <router-link
                            to="/settings/ticket"
                            class="nav-item nav-link"
                            >チケット購入</router-link
                        >
                        <a
                            href="#"
                            @click.prevent="logout"
                            class="nav-item nav-link"
                        >
                            ログアウト
                        </a>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
        })
    },
    methods: {
        ...mapActions({
            logoutAction: "auth/logout"
        }),
        logout() {
            this.logoutAction()
                .then(() => {
                    this.$router.replace({
                        name: "top"
                    });
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
