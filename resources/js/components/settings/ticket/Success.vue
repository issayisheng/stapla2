<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">チケット購入</div>
                    <div class="card-body">
                        <div
                            class="alert alert-success py-3 text-center"
                            role="alert"
                            v-if="message"
                        >
                            {{ message }}
                        </div>
                        <router-link
                            to="/settings/ticket"
                            class="btn btn-primary"
                        >
                            チケット購入
                        </router-link>
                        <router-link
                            to="/settings/history"
                            class="btn btn-danger"
                        >
                            購入履歴
                        </router-link>
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
            session_id: this.$route.query.session_id,
            customer: [],
            message: ""
        };
    },
    created() {
        let self = this;
        axios
            .get("/api/success/" + this.session_id)
            .then(response => {
                self.message = response.data.message;
                self.customer = response.data;
                console.log(response.data);
            })
            .catch(error => {
                console.log(error);
            });
    }
};
</script>

<style></style>
