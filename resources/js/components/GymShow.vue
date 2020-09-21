<template>
    <div>
        <div
            class="jumbotron d-flex justify-content-center align-items-center"
            :style="{
                backgroundImage: gym.introduction_pic
                    ? 'url(' + gym.introduction_pic + ')'
                    : 'url(' + noimage + ')'
            }"
        >
            <div class="text-center jumbotron-container">
                <h1 class="site-name text-white">{{ gym.name }}</h1>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            id: this.$route.params.id,
            gym: [],
            noimage: "",
            errorMessage: ""
        };
    },
    created() {
        axios
            .get("/api/gym/" + this.id)
            .then(response => {
                this.gym = response.data;
                this.noimage = "/img/gym/noimage.png";
                // console.log(response.data);
            })
            .catch(error => {
                console.log(error);
                this.errorMessage = "データの取得に失敗しました。";
            });
    }
};
</script>

<style>
.jumbotron {
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    height: 250px;
}
</style>
