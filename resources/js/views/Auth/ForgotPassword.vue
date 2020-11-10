<template>
    <div class="login form">
        <login-header></login-header>
        <div class="container">
            <div class="form-main">
                <h1 class="form-main__title">パスワードをお忘れの方</h1>
                <div class="form-main__content">
                    <div v-if="successMessage" class="alert alert-success">
                        {{ successMessage }}
                    </div>
                    <div v-if="errorMessage" class="alert alert-danger">
                        {{ errorMessage }}
                    </div>
                    <form class="layout-form" @submit.prevent="submit(email)">
                        <div class="form-group mb-4">
                            <div>
                                <label
                                    for="email"
                                    class="col-form-label font-weight-bold"
                                    >メールアドレス</label
                                >
                            </div>
                            <input
                                id="email"
                                type="email"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.email
                                }"
                                name="email"
                                placeholder="メールアドレスを入力"
                                v-model="email"
                                @change="onChangeEmail"
                            />
                            <span
                                class="invalid-feedback"
                                role="alert"
                                v-if="errors.email"
                            >
                                <strong v-text="errors.email"></strong
                            ></span>
                            <p class="form-group-text mt-2">
                                ご登録されたメールアドレス宛てにパスワード再設定のご案内が送信されます。
                            </p>
                        </div>
                        <button
                            type="submit"
                            class="btn-default btn-default--mail"
                        >
                            送信する
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <login-footer></login-footer>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: "",
            errors: {},
            successMessage: "",
            errorMessage: ""
        };
    },
    methods: {
        submit(value) {
            this.errorMessage = "";
            this.successMessage = "";
            var self = this;
            const data = {
                email: value
            };
            axios
                .post("/api/auth/password/email", data)
                .then(response => {
                    self.errorMessage = response.data.failed;
                    self.successMessage = response.data.send;
                })
                .catch(error => {
                    let errors = {};
                    for (var key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    if (error.response.status == 422) {
                        self.errorMessage =
                            "メールアドレスを入力してください。";
                    } else {
                        self.errorMessage = error;
                    }
                    self.errors = errors;
                });
        },
        onChangeEmail: function(value) {
            const emailreg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (value === "") {
                this.errors.email = "メールアドレスは必須です。";
            } else if (emailreg.test(value)) {
                this.errors.email =
                    "メールアドレスを正しい形式で入力してください。";
            } else {
                this.errors.email = "";
            }
        }
    }
};
</script>
