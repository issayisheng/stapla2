<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div
                        class="card-header d-flex justify-content-between align-items-center"
                    >
                        <div>マイページ</div>
                        <div>
                            <router-link
                                v-if="
                                    user.password == null || user.password == ''
                                "
                                to="/settings/user_info/password"
                                class="btn btn-outline-danger"
                                >パスワード設定</router-link
                            >
                            <router-link
                                v-else
                                to="/user_info.password.edits"
                                class="btn btn-outline-primary"
                                >パスワード変更</router-link
                            >
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-6 mx-auto">
                            <div v-if="message" class="alert alert-danger">
                                {{ message }}
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold">お名前</span>
                                </div>
                                <div class="col-md-8">
                                    <div>{{ user.name }}</div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold"
                                        >メールアドレス</span
                                    >
                                </div>
                                <div class="col-md-8">
                                    <div>{{ user.email }}</div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <span class="font-weight-bold"
                                        >電話番号</span
                                    >
                                </div>
                                <div class="col-md-8">
                                    <div v-if="user.tel == null">
                                        未登録
                                    </div>
                                    <div v-else>{{ user.tel }}</div>
                                </div>
                            </div>
                            <div class="text-center">
                                <router-link
                                    class="btn btn-outline-primary"
                                    :to="`/settings/user_info/${user.id}/edit`"
                                    >編集する</router-link
                                >
                            </div>
                        </div>
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
            user: {},
            message: "",
            display: true
        };
    },
    created() {
        axios
            .get("/api/settings/user_info")
            .then(response => {
                this.user = response.data;
            })
            .catch(error => {
                this.message = "データの取得に失敗しました。";
                console.log(error);
            });
    }
};
</script>
