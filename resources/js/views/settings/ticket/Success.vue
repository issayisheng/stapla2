<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">チケット購入</div>
                    <div class="card-body">
                        <div class="col-12 col-md-6 mx-auto">
                            <div
                                class="alert alert-success py-3 text-center"
                                role="alert"
                                v-if="message"
                            >
                                {{ message }}
                            </div>
                            <div
                                class="alert alert-danger py-3 text-center"
                                role="alert"
                                v-if="errorMessage"
                            >
                                {{ errorMessage }}
                            </div>
                            <div class="text-center">
                                <router-link
                                    to="/settings/ticket"
                                    class="btn btn-outline-primary"
                                >
                                    チケット購入
                                </router-link>
                                <router-link
                                    to="/settings/history"
                                    class="btn btn-outline-danger"
                                >
                                    チケット履歴
                                </router-link>
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
            session_id: this.$route.query.session_id,
            message: "",
            errorMessage: ""
        };
    },
    created() {
        let self = this;
        axios
            .get("/api/success/" + this.session_id)
            .then(response => {
                self.message = response.data.message;
            })
            .catch(error => {
                this.errorMessage =
                    "データの更新に失敗しました。事務局までお問い合わせください。";
            });
    }
};
</script>
