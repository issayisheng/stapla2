<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">パスワードのリセット</div>
                    <div class="card-body">
                        <form @submit.prevent="update">
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
                                        placeholder="mail@stapla.net"
                                        v-model="form.email"
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
                                        v-model="form.password"
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
                                        name="password_confirmation"
                                        placeholder="パスワード確認"
                                    />
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Reset Password
                                    </button>
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
    data: function() {
        return {
            id: this.$route.params["id"],
            form: {
                email: "",
                password: "",
                password_confirmation: ""
            },
            errors: {}
        };
    },
    methods: {
        update() {
            axios
                .post("/api/auth/password/reset/" + this.id)
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    mounted() {
        this.update();
    }
};
</script>
