<template>
    <footer class="login-footer">
        <div class="login-footer__container">
            <ul class="login-nav list-unstyled">
                <li class="login-nav__item">
                    <router-link to="/terms" class="login-nav__link"
                        >利用規約</router-link
                    >
                </li>
                <li class="login-nav__item">
                    <router-link to="/privacy" class="login-nav__link"
                        >プライバシーポリシー</router-link
                    >
                </li>
                <li class="login-nav__item">
                    <router-link to="/law" class="login-nav__link"
                        >特定商取引法に基づく表記</router-link
                    >
                </li>
            </ul>
            <p class="login-copyright">&copy; 2020 STAPLA</p>
        </div>
    </footer>
</template>

<style>
.login-footer__container {
    padding: 30px 20px;
}

.login-nav {
    margin: 0 0 20px;
}

.login-nav__item {
    margin: 0 0 16px 0;
}

.login-nav__link {
    font-size: 12px;
}

.login-copyright {
    margin: 0;
    font-size: 12px;
}

@media screen and (min-width: 768px) {
    .login-footer__container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        max-width: 1380px;
        padding: 40px 20px;
        margin: 0 auto;
    }

    .login-nav {
        display: flex;
        justify-content: center;
        margin: 0 0 40px;
    }

    .login-nav__item {
        margin: 0 25px 0 0;
    }

    .login-nav__item:last-child {
        margin: 0;
    }

    .login-nav__link:hover {
        text-decoration: underline;
    }
}
</style>
