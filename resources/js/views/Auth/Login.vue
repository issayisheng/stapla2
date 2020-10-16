<template>
    <div class="login form">
        <div class="container">
            <div class="form-logo">
                <router-link to="/" class="form-logo__link">Stapla</router-link>
            </div>
            <div class="form-main">
                <h1 class="form-main__title">ログイン</h1>
                <div v-if="message" class="alert alert-danger">
                    {{ message }}
                </div>
                <form class="layout-form" @submit.prevent="submit">
                    <div class="form-group">
                        <input
                            id="email"
                            type="email"
                            class="form-control"
                            :class="{
                                'is-invalid': errors.email
                            }"
                            name="email"
                            placeholder="メールアドレスを入力"
                            v-model="form.email"
                            @change="onChangeEmail"
                        />
                        <span
                            class="invalid-feedback"
                            role="alert"
                            v-if="errors.email"
                        >
                            <strong v-text="errors.email"></strong
                        ></span>
                    </div>
                    <div class="form-group">
                        <input
                            id="password"
                            type="password"
                            class="form-control"
                            :class="{
                                'is-invalid': errors.password
                            }"
                            name="password"
                            placeholder="パスワードを入力"
                            v-model="form.password"
                            @change="onChangePassword"
                        />
                        <span
                            class="invalid-feedback"
                            role="alert"
                            v-if="errors.password"
                        >
                            <strong v-text="errors.password"></strong
                        ></span>
                    </div>
                    <button type="submit" class="btn-default btn-default--mail">
                        ログイン
                    </button>
                    <router-link to="password/email" class="form__link"
                        >パスワードを忘れた方はこちら</router-link
                    >
                </form>
                <div class="social-form">
                    <p class="social-form__deco">または</p>
                    <a
                        class="btn-default btn-default--facebook"
                        href="/auth/login/facebook"
                    >
                        <img
                            :src="'/img/facebook-logo.svg'"
                            alt="Facebook"
                            class="btn-default__logo"
                        />Facebookでログイン
                    </a>
                    <a
                        class="btn-default btn-default--google"
                        href="api/auth/login/google"
                    >
                        <img
                            :src="'/img/google-logo.svg'"
                            alt="Google"
                            class="btn-default__logo"
                        />Googleでログイン
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
    data() {
        return {
            form: {
                email: "",
                password: ""
            },
            errors: {},
            message: ""
        };
    },
    methods: {
        ...mapActions({
            login: "auth/login"
        }),
        submit() {
            this.errors = {};
            this.message = "";
            var self = this;
            this.login(this.form)
                .then(() => {
                    this.$router.replace({
                        name: "dashboard"
                    });
                })
                .catch(error => {
                    var errors = {};
                    var message = "";
                    for (var key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    this.errors = errors;
                    if (error.response.status == 401) {
                        this.message = "ログイン情報が登録されていません。";
                    } else if (error.response.status == 422) {
                        this.message = "以下の項目を入力してください。";
                    }
                });
        },
        onChangeEmail: function(value) {
            const emailres = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (value === "") {
                this.errors.email = "メールアドレスは必須です。";
            } else if (emailres.test(value)) {
                this.errors.email = "";
            } else {
                this.errors.email = "";
            }
        },
        onChangePassword: function(value) {
            const passwordres = /^[a-zA-Z0-9]+$/;
            if (value === "") {
                this.errors.password = "パスワードは必ず指定してください。";
            } else if (passwordres.test(value)) {
                this.error.username = "パスワードは半角英数のみです。";
            } else {
                this.errors.password = "";
            }
        }
    }
};
</script>

<style>
.form {
    padding: 45px 0 70px;
}

.form-logo {
    text-align: center;
    margin: 0 0 40px;
    font-size: 30px;
}

.form-logo__link {
    color: #333;
}

.form-logo__link:hover {
    text-decoration: none;
}

.form-main {
    display: flex;
    flex-direction: column;
    width: 100%;
    padding: 32px;
    margin: 0 auto;
    background-color: #ffffff;
    border: 1px solid #d6d6d6;
    border-radius: 4px;
}

@media screen and (min-width: 768px) {
    .form-main {
        width: 400px;
    }
}

.form-main__title {
    font-size: 20px;
    text-align: center;
    margin: 0 0 20px;
    font-weight: 700;
}

.layout-form {
    max-width: 400px;
    margin: 0 auto;
    width: 100%;
}

.form__desc {
    margin: 0 0 20px;
}

.form-group {
    margin: 0 0 20px;
}

.form-control {
    padding: 12px 16px 10px;
    height: auto;
}

.form__link {
    color: #00a1e9;
}

.form__link:hover {
    opacity: 0.8;
}

.login .form__link {
    margin: 20px 0 0;
    display: block;
    text-align: center;
}

.social-form {
    margin: 32px 0 0;
}

.social-form__deco {
    color: #a0a0a0;
    font-size: 14px;
    display: flex;
    align-items: center;
}

.social-form__deco::before,
.social-form__deco:after {
    content: "";
    flex-grow: 1;
    height: 1px;
    background: rgba(30, 30, 30, 0.2);
    display: block;
}

.social-form__deco:before {
    margin-right: 2.5em;
}

.social-form__deco:after {
    margin-left: 2.5em;
}

.password-reset__link {
    color: #00a1e9;
    padding: 16px 0 0;
    text-align: center;
    border-top: 1px solid rgb(213, 216, 222);
}

.password-reset__info {
    font-size: 12px;
    color: #7a7a7a;
    margin: 10px 0 0;
    line-height: 1.5;
}

.btn-default {
    display: block;
    width: 100%;
    font-size: 14px;
    border-radius: 3px;
    border: none;
    cursor: pointer;
    text-align: center;
    padding: 12px 0;
    position: relative;
    outline: none;
    transition: opacity 0.2s;
}

.btn-default:hover {
    opacity: 0.8;
}

.btn-default:focus {
    outline: none;
}

.btn-default--mail {
    background: #ef1d1d;
    color: #fff;
}

.btn-default--facebook {
    background: #3b5998;
    color: #fff;
    margin: 0 0 16px;
}

.btn-default--google {
    background: #fff;
    color: rgba(0, 0, 0, 0.54);
    border: 1px solid #ced4da;
}

.btn-default__logo {
    position: absolute;
    left: 16px;
    height: 18px;
    width: 18px;
    top: 0;
    bottom: 0;
    margin: auto;
}
</style>
