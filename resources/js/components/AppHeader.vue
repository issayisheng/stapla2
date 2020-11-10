<template>
    <header class="app-header">
        <nav
            class="app-header__navbar navbar navbar-expand-md navbar-light bg-white container"
        >
            <div class="app-header__logo">
                <router-link class="navbar-brand" to="/"
                    ><img
                        :src="'/img/common/logo.svg'"
                        alt="STAPLA"
                        class="logo-img"
                /></router-link>
            </div>
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

            <div
                class="collapse navbar-collapse flex-md-row-reverse"
                id="navbarSupportedContent"
            >
                <div class="app-header-main">
                    <ul class="app-header-nav list-unstyled">
                        <li class="app-header-nav__item">
                            <a href="">コンセプト</a>
                        </li>
                        <li class="app-header-nav__item">
                            <a href="">特徴</a>
                        </li>
                        <li class="app-header-nav__item">
                            <a href="">ご利用の流れ</a>
                        </li>
                    </ul>
                    <div class="app-header-form">
                        <router-link to="/login" class="app-header-form__login"
                            >ログイン</router-link
                        >
                        <router-link
                            to="/register"
                            class="app-header-form__register"
                            >新規登録</router-link
                        >
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<style>
.app-header {
    background: #fff;
    border-bottom: 1px solid #f2f2f2;
}

.logo-img {
    display: block;
    width: 110px;
    height: 22px;
}

.app-header-nav__item a {
    padding: 8px 0;
    display: block;
}

.app-header-form__login {
    display: block;
    border: 1px solid #ccc;
    padding: 8px;
    background: #f8f9fa;
    border-radius: 3px;
    text-align: center;
    margin: 0 0 16px;
}

.app-header-form__register {
    width: 100%;
    padding: 10px 0;
    text-align: center;
    color: #fff;
    background-color: #f17436;
    border-radius: 3px;
    display: block;
}

@media screen and (min-width: 768px) {
    .app-header {
        height: 75px;
    }

    .app-header__navbar {
        height: 100%;
    }

    .app-header-main {
        display: flex;
        align-items: center;
    }

    .app-header-nav {
        display: flex;
        margin: 0;
    }

    .app-header-nav__item {
        margin: 0 40px 0 0;
    }

    .app-header-form {
        display: flex;
        align-items: center;
        padding: 0 0 0 40px;
        border-left: 1px solid #e2e2e2;
    }

    .app-header-form__login {
        margin: 0 24px 0 0;
        font-weight: 700;
        border: none;
        padding: 0;
        background: #fff;
    }

    .app-header-form__login:hover {
        opacity: 0.8;
    }

    .app-header-form__register {
        width: 120px;
    }

    .app-header-form__register:hover {
        color: #fff;
    }
}
</style>
