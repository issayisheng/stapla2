<template>
    <div class="login form">
        <div class="container">
            <div class="form-logo">
                <router-link to="/" class="form-logo__link">Stapla</router-link>
            </div>
            <div class="form-main">
                <div v-if="successMessage" class="alert alert-success">
                    {{ successMessage }}
                </div>
                <h1 class="form-main__title">パスワードをお忘れの方</h1>
                <div v-if="errorMessage" class="alert alert-danger">
                    {{ errorMessage }}
                </div>
                <form class="layout-form" @submit.prevent="submit">
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
                            v-model="forgotForm.email"
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
                    <button type="submit" class="btn-default btn-default--mail">
                        送信する
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            forgotForm: {
                email: ""
            },
            errors: {},
            successMessage: "",
            errorMessage: ""
        };
    },
    methods: {
        submit: function() {
            this.errorMessage = "";
            this.successMessage = "";
            var self = this;
            // const data = {
            //     email: "sasaki.shota@example.com" //今回投げるuserid
            // };
            axios
                .post("/api/auth/password/email")
                .then(response => {
                    console.log(response);
                    self.successMessage = response.message;
                })
                .catch(error => {
                    let errors = {};
                    console.log(error);
                    for (var key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    this.errors = errors;
                    self.errorMessage = error.message;
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
