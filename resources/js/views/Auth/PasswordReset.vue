<template>
    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">パスワードのリセット</div>
                    <div class="card-body">
                        <form @submit.prevent="update">
                            <div class="col-md-8 mx-auto">
                                <div
                                    v-if="successMessage"
                                    class="alert alert-success"
                                >
                                    {{ successMessage }}
                                </div>
                                <div
                                    v-if="errorMessage"
                                    class="alert alert-danger"
                                >
                                    {{ errorMessage }}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    for="email"
                                    class="col-md-4 col-form-label text-md-right"
                                    >メールアドレス</label
                                >
                                <div class="col-md-6">
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control"
                                        :class="{
                                            'is-invalid': errors.email
                                        }"
                                        name="email"
                                        placeholder="ご登録のメールアドレス"
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
                            </div>
                            <div class="form-group row">
                                <label
                                    for="password"
                                    class="col-md-4 col-form-label text-md-right"
                                    >パスワード</label
                                >
                                <div class="col-md-6">
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control"
                                        :class="{
                                            'is-invalid': errors.password
                                        }"
                                        name="password"
                                        placeholder="8文字以上の半角英数記号"
                                        v-model="password"
                                    />
                                    <span
                                        class="invalid-feedback"
                                        role="alert"
                                        v-if="errors.password"
                                    >
                                        <strong
                                            v-text="errors.password"
                                        ></strong
                                    ></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right"
                                    >パスワード確認</label
                                >
                                <div class="col-md-6">
                                    <input
                                        id="password-confirm"
                                        type="password"
                                        class="form-control"
                                        placeholder="パスワード確認"
                                        name="password_confirmation"
                                        v-model="password_confirmation"
                                    />
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        パスワードリセットする
                                    </button>
                                    <router-link
                                        to="/login"
                                        class="btn btn-secondary"
                                        >ログイン画面に戻る</router-link
                                    >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            id: this.$route.params["id"],
            email: "",
            password: "",
            password_confirmation: "",
            errors: {},
            errorMessage: "",
            successMessage: ""
        };
    },
    methods: {
        update() {
            this.errorMessage = "";
            this.successMessage = "";
            var self = this;
            const data = {
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
                token: this.id
            };
            axios
                .post("/api/auth/password/reset/" + this.id, data)
                .then(response => {
                    if (response.data.failed === "passwords.token") {
                        self.errorMessage = "無効なトークンです。";
                    } else if (response.data.failed === "passwords.user") {
                        self.errorMessage = "該当ユーザーがいません。";
                    }
                    self.successMessage = response.data.success;
                })
                .catch(error => {
                    console.log(error);
                    let errors = {};
                    for (var key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    self.errors = errors;
                });
        }
    }
};
</script>
