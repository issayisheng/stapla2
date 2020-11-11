<template>
    <div>
        <login-header></login-header>
        <div class="container">
            <div class="form-main">
                <h1 class="form-main__title">新規登録</h1>
                <div class="form-main__content">
                    <div class="form-btn__list">
                        <router-link
                            class="btn-default btn-default--mail"
                            to="/register/email"
                        >
                            <img
                                :src="'/img/common/mail.svg'"
                                alt="Facebook"
                                class="btn-default__logo"
                            />
                            メールアドレスで登録
                        </router-link>
                        <a
                            class="btn-default btn-default--facebook"
                            href="/login/facebook"
                        >
                            <img
                                :src="'/img/common/facebook-logo.svg'"
                                alt="Facebook"
                                class="btn-default__logo"
                            />Facebookで登録
                        </a>
                        <a
                            class="btn-default btn-default--google"
                            href="/login/google"
                        >
                            <img
                                :src="'/img/common/google-logo.svg'"
                                alt="Google"
                                class="btn-default__logo"
                            />Googleで登録
                        </a>
                    </div>
                    <div class="form-desc">
                        登録することで、
                        <router-link to="/terms" class="form-desc__link"
                            >利用規約</router-link
                        >と
                        <router-link to="/privacy" class="form-desc__link"
                            >プライバシーポリシー</router-link
                        >
                        に同意したものとみなされます。
                    </div>
                </div>
            </div>
        </div>
        <login-footer></login-footer>
    </div>
</template>

<style>
.form-btn__list {
    margin: 0 0 40px;
}

.form-desc {
    color: #888;
}
</style>
