<template>
    <div>
        <div
            class="jumbotron d-flex justify-content-center align-items-center"
            :style="{
                backgroundImage: gym.introduction_pic
                    ? 'url(' + '/' + gym.introduction_pic + ')'
                    : 'url(' + noimage + ')'
            }"
        >
            <div class="text-center jumbotron-container">
                <h1 class="site-name text-white">{{ gym.name }}</h1>
            </div>
        </div>
        <div class="container pb-5">
            <div class="card">
                <div class="card-body">
                    <div class="py-4 text-center">
                        <h5 class="mb-3">予約が完了しました。</h5>
                        <router-link
                            to="/settings/reservation"
                            class="btn btn-outline-primary"
                            >予約確認</router-link
                        >
                        <router-link
                            to="/dashboard"
                            class="btn btn-outline-secondary"
                            >ダッシュボード</router-link
                        >
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
            gym: {},
            noimage: "",
            errorMessage: ""
        };
    },
    created() {
        axios
            .get("/api/reserve/success/" + this.id)
            .then(response => {
                console.log(response);
                this.gym = response.data.gym;
                this.noimage = "/img/gym/noimage.png";
            })
            .catch(error => {
                console.log(error);
                this.errorMessage = "データの取得に失敗しました。";
            });
    }
};
</script>
