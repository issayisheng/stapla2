<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <!-- @guest -->
            <!-- <a class="navbar-brand" href="{{ url('/') }}">
                {{ config("app.name", "Stapla") }}
            </a> -->
            <!-- @else -->
            <router-link to="/dashboard" class="navbar-brand"
                >Stapla</router-link
            >
            <!-- @endguest -->
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
            >
                <!-- aria-label="{{ __('Toggle navigation') }}" -->
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto"></ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <!-- @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{
                            __("Login")
                        }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{
                            __("Register")
                        }}</a>
                    </li>
                    @endif @else -->
                    <template v-if="authenticated">
                        <li class="nav-item dropdown">
                            <a
                                id="navbarDropdown"
                                class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                {{ user.name }}
                                <span class="caret"></span>
                            </a>
                            <div
                                class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="navbarDropdown"
                            >
                                <router-link
                                    to="/settings/user_info"
                                    class="dropdown-item"
                                    >マイページ</router-link
                                >
                                <!-- @if( Auth::user()->status === null ||
                            Auth::user()->status ===
                            config('consts.user.TRAINER') ) -->
                                <router-link
                                    v-if="user.status == null"
                                    to="/settings/gym_info/create"
                                    class="dropdown-item"
                                    >ジム登録</router-link
                                >
                                <!-- @else -->
                                <router-link
                                    to="/settings/gym_info"
                                    class="dropdown-item"
                                    >ジム管理</router-link
                                >
                                <!-- @endif -->
                                <router-link
                                    v-if="user.status == 5"
                                    to="/settings/trainer"
                                    class="dropdown-item"
                                    >トレーナー管理</router-link
                                >
                                <router-link
                                    to="/settings/reserved"
                                    class="dropdown-item"
                                    >予約状況</router-link
                                >
                                <router-link
                                    to="/settings/ticket"
                                    class="dropdown-item"
                                    >チケット購入</router-link
                                >
                                <a
                                    href="#"
                                    @click.prevent="logout"
                                    class="dropdown-item"
                                >
                                    ログアウト
                                </a>
                            </div>
                        </li>
                    </template>
                    <!-- @endguest -->
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
