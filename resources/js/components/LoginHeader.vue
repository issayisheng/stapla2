<template>
    <header class="login-header">
        <nav
            class="login-header__navbar navbar navbar-expand-md navbar-light bg-white container"
        >
            <div class="login-header__logo">
                <router-link class="navbar-brand" to="/"
                    ><img :src="'/img/common/logo.svg'" alt="STAPLA"
                /></router-link>
            </div>
        </nav>
    </header>
</template>

<style>
.login-header {
    background: #fff;
    border-bottom: 1px solid #ddd;
    margin: 0 0 30px;
    height: 60px;
}

.login-header__logo img {
    display: block;
    width: 110px;
    height: 22px;
}

.login-header-nav__item a {
    padding: 8px 0;
    display: block;
}

@media screen and (min-width: 768px) {
    .login-header {
        margin: 0 0 60px;
    }

    .login-header__navbar {
        height: 100%;
    }

    .login-header-main {
        display: flex;
        align-items: center;
    }

    .login-header-nav {
        display: flex;
        margin: 0;
    }

    .login-header-nav__item {
        margin: 0 40px 0 0;
    }
}
</style>
