<template>
    <div class="signup form">
        <div class="container">
            <div class="form-logo">
                <router-link to="/" class="form-logo__link">Stapla</router-link>
            </div>
            <div class="form-main">
                <h1 class="form-main__title">新規登録</h1>
                <form class="layout-form" @submit.prevent="registerUser">
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
                            placeholder="yamada taro"
                            v-model="name"
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
                            name="email"
                            class="form-control"
                            :class="{
                                'is-invalid': errors.email
                            }"
                            placeholder="mail@stapla.net"
                            v-model="email"
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
                            name="password"
                            class="form-control"
                            :class="{
                                'is-invalid': errors.password
                            }"
                            placeholder="8文字以上の半角英数記号"
                            v-model="password"
                        />
                        <span
                            class="invalid-feedback"
                            role="alert"
                            v-if="errors.password"
                        >
                            <strong v-text="errors.password"></strong
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
                        新規登録する
                    </button>
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
                        />Facebookで登録する
                    </a>
                    <a
                        class="btn-default btn-default--google"
                        href="/login/google"
                    >
                        <img
                            src="img/google-logo.svg"
                            alt="Google"
                            class="btn-default__logo"
                        />Googleで登録する
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            name: "",
            email: "",
            password: "",
            errors: {}
        };
    },
    methods: {
        registerUser: function() {
            this.errors = {};
            var self = this;
            var url = "/register";
            var params = {
                name: this.name,
                email: this.email,
                password: this.password
            };
            axios
                .post(url, params)
                .then(function(response) {
                    location.href = "/dashboard";
                    // console.log(response.data);
                })
                .catch(function(error) {
                    var errors = {};
                    for (var key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    self.errors = errors;
                    console.log(errors);
                });
        }
    }
};
</script>

<style></style>
