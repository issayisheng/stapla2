<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">マイページ</div>
                    <div class="card-body">
                        <div class="list-group layout-form">
                            <div v-if="message" class="alert alert-danger">
                                {{ message }}
                            </div>
                            <div
                                v-for="user in users"
                                :key="user.id"
                                class="mb-5"
                            >
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="font-weight-bold"
                                            >お名前</label
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ user.name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="font-weight-bold"
                                            >メールアドレス</label
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ user.email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="font-weight-bold"
                                            >電話番号</label
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ user.tel }}</p>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <router-link
                                        :to="{
                                            name: 'userinfo_edit',
                                            params: { id: user.id }
                                        }"
                                        class="btn btn-primary mr-5"
                                        >編集する</router-link
                                    >
                                    <router-link
                                        v-if="
                                            user.password == null ||
                                                user.password == ''
                                        "
                                        to="/settings/user_info/password"
                                        class="btn btn-danger"
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
            users: [],
            message: "",
            display: true
        };
    },
    created() {
        axios
            .get("/api/settings/user_info")
            .then(response => {
                this.users = response.data;
                // console.log(response.data);
            })
            .catch(error => {
                this.message = "データの取得に失敗しました。";
                console.log(error);
            });
    }
};
</script>
