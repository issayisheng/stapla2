<template>
    <header class="header">
        <nav
            class="header__navbar navbar navbar-expand-md navbar-light bg-white container"
        >
            <div class="header__logo">
                <router-link class="navbar-brand" to="/"
                    ><img :src="'img/common/logo.svg'" alt="STAPLA"
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
                <div class="header-main">
                    <ul class="header-nav list-unstyled">
                        <li class="header-nav__item">
                            <a href="">コンセプト</a>
                        </li>
                        <li class="header-nav__item">
                            <a href="">特徴</a>
                        </li>
                        <li class="header-nav__item">
                            <a href="">ご利用の流れ</a>
                        </li>
                    </ul>
                    <div class="header-form">
                        <router-link to="/login" class="header-form__login"
                            >ログイン</router-link
                        >
                        <router-link
                            to="/register"
                            class="header-form__register"
                            >新規登録</router-link
                        >
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<style>
.header {
    background: #fff;
    border-bottom: 1px solid #f2f2f2;
}

.header__logo img {
    display: block;
    width: 110px;
    height: 22px;
}

.header-nav {
    margin: 0;
}

.header-nav__item a {
    padding: 8px 0;
    display: block;
}

.header-form__login {
    display: block;
    border: 1px solid #ccc;
    padding: 8px;
    background: #f8f9fa;
    border-radius: 3px;
    text-align: center;
    margin: 0 0 16px;
}

.header-form__register {
    width: 100%;
    padding: 10px 0;
    text-align: center;
    color: #fff;
    background-color: #ff5722;
    border-radius: 3px;
    display: block;
}

@media screen and (min-width: 768px) {
    .header {
        height: 75px;
    }

    .header__navbar {
        height: 100%;
    }

    .header-main {
        display: flex;
        align-items: center;
    }

    .header-nav {
        display: flex;
    }

    .header-nav__item {
        margin: 0 40px 0 0;
    }

    .header-form {
        display: flex;
        align-items: center;
        padding: 0 0 0 40px;
        border-left: 1px solid #e2e2e2;
    }

    .header-form__login {
        margin: 0 24px 0 0;
        font-weight: 700;
        border: none;
        padding: 0;
        background: #fff;
    }

    .header-form__login:hover {
        opacity: 0.8;
    }

    .header-form__register {
        width: 120px;
    }

    .header-form__register:hover {
        color: #fff;
    }
}
</style>
