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
                    <router-link to="password.request" class="form__link"
                        >パスワードを忘れた方はこちら</router-link
                    >
                </form>
                <div class="social-form">
                    <p class="social-form__deco">または</p>
                    <a
                        class="btn-default btn-default--facebook"
                        href="/login/facebook"
                    >
                        <img
                            src="img/facebook-logo.svg"
                            alt="Facebook"
                            class="btn-default__logo"
                        />Facebookでログイン
                    </a>
                    <a
                        class="btn-default btn-default--google"
                        href="/login/google"
                    >
                        <img
                            src="img/google-logo.svg"
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

<style></style>
