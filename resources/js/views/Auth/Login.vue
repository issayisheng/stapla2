<template>
    <div>
        <login-header></login-header>
        <div class="container">
            <div class="form-main">
                <h1 class="form-main__title">ログイン</h1>
                <div class="form-main__content">
                    <div v-if="message" class="alert alert-danger">
                        {{ message }}
                    </div>
                    <form class="login-form" @submit.prevent="submit">
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
                        <button
                            type="submit"
                            class="btn-default btn-default--mail"
                        >
                            ログイン
                        </button>
                        <div>
                            <router-link to="/register" class="form-main__link"
                                >新規登録の方</router-link
                            >
                            <router-link
                                to="password/email"
                                class="form-main__link"
                                >パスワードを忘れた方はこちら</router-link
                            >
                        </div>
                    </form>
                    <div class="social-form">
                        <p class="social-form__deco">または</p>
                        <a
                            class="btn-default btn-default--facebook"
                            href="/login/facebook"
                        >
                            <img
                                :src="'/img/common/facebook-logo.svg'"
                                alt="Facebook"
                                class="btn-default__logo"
                            />Facebookでログイン
                        </a>
                        <a
                            class="btn-default btn-default--google"
                            href="/login/google"
                        >
                            <img
                                :src="'/img/common/google-logo.svg'"
                                alt="Google"
                                class="btn-default__logo"
                            />Googleでログイン
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <login-footer></login-footer>
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
                    this.flash("ログインしました", "success", {
                        timeout: 3000
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
.form-main {
    display: flex;
    flex-direction: column;
    background-color: #fff;
    border-radius: 2px;
}

.form-main__title {
    font-size: 20px;
    text-align: center;
    margin: 0 0 30px;
    font-weight: 700;
    padding: 24px 20px;
    border-bottom: solid 2px #f2f2f2;
}

.form-main__content {
    max-width: 380px;
    margin: 0 auto 40px;
    padding: 0 16px;
    width: 100%;
}

.login-form {
    margin: 0 0 30px;
}

.form-group {
    margin: 0 0 20px;
}

.form-control {
    padding: 12px 16px 10px;
    height: auto;
}

.form-main__link {
    color: #00a1e9;
    display: block;
    margin: 0 0 10px;
}

.form-desc__link {
    color: #00a1e9;
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

.btn-default {
    display: block;
    width: 100%;
    font-size: 14px;
    border-radius: 3px;
    border: none;
    height: 48px;
    cursor: pointer;
    text-align: center;
    padding: 12px 0;
    position: relative;
    outline: none;
    transition: opacity 0.2s;
    margin: 0 0 16px;
}

.btn-default:focus {
    outline: none;
}

.btn-default--mail {
    background: #f17436;
    color: #fff;
}

.btn-default--facebook {
    background: #3b5998;
    color: #fff;
}

.btn-default--google {
    background: #fff;
    color: rgba(0, 0, 0, 0.54);
    border: 1px solid #ced4da;
    margin: 0;
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

@media screen and (min-width: 768px) {
    .form-main {
        width: 650px;
        margin: 0 auto;
    }

    .form-main__title {
        margin: 0 0 40px;
    }

    .form-main__link:hover {
        text-decoration: underline;
    }

    .form-desc__link:hover {
        text-decoration: underline;
    }

    .btn-default:hover {
        opacity: 0.8;
    }
}
</style>
