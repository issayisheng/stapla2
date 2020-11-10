<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">プロフィール編集</div>
                    <div class="card-body">
                        <form
                            @submit.prevent="updateUserInfo"
                            class="py-3 col-md-6 mx-auto"
                        >
                            <div class="form-group">
                                <div>
                                    <label
                                        for="name"
                                        class="col-form-label font-weight-bold"
                                        >お名前<span
                                            class="badge badge-danger p-1 ml-1 align-middle"
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
                                    placeholder="例）スタプラ太郎"
                                    v-model="user.name"
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
                                <div>
                                    <label
                                        for="email"
                                        class="col-form-label font-weight-bold"
                                        >メールアドレス<span
                                            class="badge badge-danger p-1 ml-1 align-middle"
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
                            <div class="form-group mb-4">
                                <div>
                                    <label
                                        for="tel"
                                        class="col-form-label font-weight-bold"
                                        >電話番号<span
                                            class="badge badge-secondary p-1 ml-1 align-middle"
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
                                    class="btn btn-outline-primary btn-block mb-3"
                                >
                                    変更
                                </button>
                                <button
                                    class="btn btn-outline-secondary btn-block"
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
                    this.flash("編集に成功しました", "success", {
                        timeout: 3000
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
        },
        onChangeName: function(value) {
            if (value === "") {
                this.errors.name = "お名前は必ず指定してください。";
            } else {
                this.errors.name = "";
            }
        },
        onChangeEmail: function(value) {
            // const res = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (value === "") {
                this.errors.email = "メールアドレスは必ず指定してください。";
            }
            // else if (res.test(value)) {
            //     this.errors.email = "正しい形式で入力してください";
            // }
            else {
                this.errors.email = "";
            }
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
