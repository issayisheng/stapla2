<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">パスワード設定</div>

                    <!-- @if (session('change_password_error'))
                    <div class="container mt-2">
                        <div class="alert alert-danger mb-0">
                            {{ session("change_password_error") }}
                        </div>
                    </div>
                    @endif -->
                    <div v-if="saved" class="alert alert-primary" role="alert">
                        保存しました
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="password">
                                    新しいパスワード
                                </label>
                                <div>
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control"
                                        placeholder="8文字以上の半角英数記号"
                                        v-model="newpassword"
                                        :class="{
                                            'is-invalid': errors.newpassword
                                        }"
                                    />
                                    <span
                                        class="invalid-feedback"
                                        role="alert"
                                        v-if="errors.newpassword"
                                    >
                                        <strong
                                            v-text="errors.newpassword"
                                        ></strong
                                    ></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm">
                                    新しいパスワード確認
                                </label>
                                <div>
                                    <input
                                        id="confirm"
                                        type="password"
                                        class="form-control"
                                        name="newpassword_confirmation"
                                        placeholder="新しいパスワードを再入力"
                                        v-model="confirm"
                                    />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div>
                                    <button
                                        class="btn btn-secondary"
                                        @click.prevent="back"
                                    >
                                        戻る
                                    </button>
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                        name="action"
                                        value="edit"
                                        @click.prevent="create"
                                    >
                                        登録
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
            saved: false,
            newpassword: "",
            confirm: "",
            errors: {}
        };
    },
    methods: {
        back() {
            this.$router.back(); // 1つ前へ
        },
        create: function() {
            this.errors = {};
            axios
                .post("/api/settings/user_info/password", {
                    newpassword: this.newpassword,
                    confirm: this.confirm
                })
                .then(response => {
                    this.newpassword = "";
                    this.confirm = "";
                    this.saved = true;
                    console.log("created");
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
