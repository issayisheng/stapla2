<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">プロフィール編集</div>
                    <div class="card-body">
                        <form
                            @submit.prevent="updateUserInfo"
                            class="layout-form py-3"
                        >
                            <div class="form-group">
                                <div>
                                    <label
                                        for="name"
                                        class="col-form-label font-weight-bold"
                                        >お名前<span
                                            class="badge badge-danger p-1 ml-1"
                                            >必須</span
                                        ></label
                                    >
                                </div>
                                <input
                                    id="name"
                                    type="text"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': errors.name
                                    }"
                                    name="name"
                                    placeholder="例）PAL烏丸御池"
                                    v-model="user.name"
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
                                <div>
                                    <label
                                        for="email"
                                        class="col-form-label font-weight-bold"
                                        >メールアドレス<span
                                            class="badge badge-danger p-1 ml-1"
                                            >必須</span
                                        ></label
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
                                    placeholder="例）mail@stapla.net"
                                    v-model="user.email"
                                />
                                <span
                                    class="invalid-feedback"
                                    role="alert"
                                    v-if="errors.email"
                                >
                                    <strong v-text="errors.email"></strong
                                ></span>
                            </div>
                            <div class="form-group mb-4">
                                <div>
                                    <label
                                        for="tel"
                                        class="col-form-label font-weight-bold"
                                        >電話番号<span
                                            class="badge badge-secondary p-1 ml-1"
                                            >任意</span
                                        ></label
                                    >
                                </div>
                                <input
                                    id="tel"
                                    type="tel"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': errors.tel
                                    }"
                                    name="tel"
                                    placeholder="例）08012345678"
                                    v-model="user.tel"
                                />

                                <span
                                    class="invalid-feedback"
                                    role="alert"
                                    v-if="errors.tel"
                                >
                                    <strong v-text="errors.tel"></strong
                                ></span>
                                <p class="form-group-text">
                                    ※ハイフン抜き、半角数字で入力してください。
                                </p>
                            </div>
                            <div class="col-md-8 offset-md-2">
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-block mb-3"
                                >
                                    変更
                                </button>
                                <button
                                    class="btn btn-secondary btn-block"
                                    @click.prevent="back"
                                >
                                    戻る
                                </button>
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
            id: this.$route.params.id,
            user: {},
            errors: {}
        };
    },
    created() {
        axios
            .get("/api/settings/user_info/" + this.id)
            .then(response => {
                this.user = response.data;
            })
            .catch(error => {
                console.log(error);
            });
    },
    methods: {
        back() {
            this.$router.back(); // 1つ前へ
        },
        updateUserInfo: function() {
            this.errors = {};
            axios
                .put("/api/settings/user_info/" + this.user.id, {
                    name: this.user.name,
                    email: this.user.email,
                    tel: this.user.tel
                })
                .then(response => {
                    this.user = response.data.user;
                    this.$router.push({
                        name: "userinfo",
                        params: { id: this.$route.params.id }
                    });
                })
                .catch(error => {
                    var errors = {};
                    for (var key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    this.errors = errors;
                    console.log(error);
                });
        }
    }
};
</script>

<style>
.form-group-text {
    color: #888;
    font-size: 12px;
}
</style>
