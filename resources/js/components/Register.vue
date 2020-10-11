<template>
    <div class="signup form">
        <div class="container">
            <div class="form-logo">
                <router-link to="/" class="form-logo__link">Stapla</router-link>
            </div>
            <div class="form-main">
                <h1 class="form-main__title">新規登録</h1>
                <form @submit.prevent="signup">
                    <div class="form-group">
                        <label for="name" class="font-weight-bold"
                            >お名前</label
                        >
                        <input
                            id="name"
                            type="text"
                            name="name"
                            class="form-control"
                            :class="{
                                'is-invalid': errors.name
                            }"
                            autofocus
                            placeholder="スタプラ太郎"
                            v-model="form.name"
                            @change="onChangeName"
                        />
                        <span
                            class="invalid-feedback"
                            role="alert"
                            v-if="errors.name"
                        >
                            <strong v-text="errors.name"></strong
                        ></span>
                    </div>
                    <div class="form-group">
                        <label for="email" class="font-weight-bold"
                            >メールアドレス</label
                        >
                        <input
                            id="email"
                            type="email"
                            class="form-control"
                            :class="{
                                'is-invalid': errors.email
                            }"
                            name="email"
                            placeholder="mail@stapla.net"
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
                        <label for="password" class="font-weight-bold"
                            >パスワード</label
                        >
                        <input
                            id="password"
                            type="password"
                            class="form-control"
                            :class="{
                                'is-invalid': errors.password
                            }"
                            name="password"
                            placeholder="8文字以上の半角英数記号"
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
                    <div class="form-group">
                        <label
                            for="password_confirmation"
                            class="font-weight-bold"
                            >パスワード確認</label
                        >
                        <input
                            id="password_confirmation"
                            type="password"
                            class="form-control"
                            :class="{
                                'is-invalid': errors.password_confirmation
                            }"
                            name="password_confirmation"
                            placeholder="パスワードを入力"
                            v-model="form.password_confirmation"
                        />
                        <span
                            class="invalid-feedback"
                            role="alert"
                            v-if="errors.password_confirmation"
                        >
                            <strong
                                v-text="errors.password_confirmation"
                            ></strong
                        ></span>
                    </div>
                    <div class="form__desc">
                        登録することで、
                        <router-link to="/terms" class="form__link"
                            >利用規約</router-link
                        >と
                        <router-link to="/privacy" class="form__link"
                            >プライバシーポリシー</router-link
                        >
                        に同意したものとみなされます。
                    </div>
                    <button type="submit" class="btn-default btn-default--mail">
                        新規登録
                    </button>
                </form>
                <div class="social-form">
                    <p class="social-form__deco">または</p>
                    <a
                        class="btn-default btn-default--facebook"
                        href="/login/facebook"
                    >
                        <img
                            :src="'/img/facebook-logo.svg'"
                            alt="Facebook"
                            class="btn-default__logo"
                        />Facebookで登録
                    </a>
                    <a
                        class="btn-default btn-default--google"
                        href="/login/google"
                    >
                        <img
                            :src="'/img/google-logo.svg'"
                            alt="Google"
                            class="btn-default__logo"
                        />Googleで登録
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
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            },
            errors: {}
        };
    },
    methods: {
        ...mapActions({
            register: "auth/register"
        }),
        signup() {
            this.errors = {};
            var self = this;
            this.register(this.form)
                .then(() => {
                    this.$router.replace({
                        name: "verifyemail"
                    });
                })
                .catch(error => {
                    var errors = {};
                    for (var key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    self.errors = errors;
                });
        },
        onChangeName: function(value) {
            if (value === "") {
                this.errors.name = "氏名は必ず指定してください。";
            } else {
                this.errors.name = "";
            }
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
