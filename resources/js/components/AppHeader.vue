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
                    <li class="nav-item dropdown">
                        <a
                            id="navbarDropdown"
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            v-pre
                        >
                            <!-- {{ Auth::user()->name }}  -->
                            name
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
                            <!-- <a class="dropdown-item" href="{{ route('user_info.index') }}">マイページ</a> -->
                            <!-- @if( Auth::user()->status === null ||
                            Auth::user()->status ===
                            config('consts.user.TRAINER') ) -->
                            <router-link
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
                            <!-- @if( Auth::user()->status === 5 ) -->
                            <router-link
                                to="/settings/trainer"
                                class="dropdown-item"
                                >トレーナー管理</router-link
                            >
                            <!-- @endif -->
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
                            <!-- href="{{ route('logout') }}" -->
                            <a
                                @click="logout"
                                class="dropdown-item"
                                onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();"
                            >
                                ログアウト
                            </a>
                            <!-- action="{{ route("logout") }}" -->
                            <!-- <form
                                id="logout-form"
                                method="POST"
                                style="display: none;"
                            ></form> -->
                        </div>
                    </li>
                    <!-- @endguest -->
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            user: ""
        };
    },
    // mounted() {
    //     axios.get("/api/user").then(response => {
    //         this.user = response.data;
    //     });
    // },
    methods: {
        logout() {
            axios
                .post("api/logout")
                .then(response => {
                    // console.log(response);
                    this.$router.push("/login");
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>

<style></style>
