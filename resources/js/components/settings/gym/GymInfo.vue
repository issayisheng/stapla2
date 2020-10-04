<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div
                        class="card-header d-flex justify-content-between align-items-center"
                    >
                        ジム管理ページ
                        <router-link
                            to="/settings/gym_info/create"
                            class="btn btn-success"
                        >
                            ジム追加登録
                        </router-link>
                    </div>
                    <div class="card-body">
                        <div v-if="errorMessage" class="alert alert-danger">
                            {{ errorMessage }}
                        </div>
                        <div class="card-group" v-if="gyms.length == 0">
                            現在登録されていません。
                        </div>
                        <div class="card-group" v-else>
                            <div
                                v-for="gym in gyms"
                                :key="gym.id"
                                class="col-sm-12 col-md-6 col-lg-4 px-0 px-md-3"
                            >
                                <div class="card mb-3">
                                    <img
                                        class="card-img-top"
                                        :src="
                                            gym.introduction_pic
                                                ? gym.introduction_pic
                                                : noimage
                                        "
                                    />
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">
                                            {{ gym.name }}
                                        </h5>
                                        <router-link
                                            :to="{
                                                name: 'gyminfo_show',
                                                params: { id: gym.id }
                                            }"
                                            class="btn btn-outline-primary mb-3 d-block"
                                        >
                                            詳細をみる
                                        </router-link>
                                        <button
                                            class="btn btn-outline-danger d-block w-100"
                                            @click="deleteGym(gym.id)"
                                        >
                                            削除する
                                        </button>
                                    </div>
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
            gyms: [],
            noimage: "",
            errorMessage: ""
        };
    },
    created() {
        axios
            .get("/api/settings/gym_info")
            .then(response => {
                this.gyms = response.data;
                this.noimage = "/img/gym/noimage.png";
            })
            .catch(error => {
                console.log(error);
                this.errorMessage = "データの取得に失敗しました。";
            });
    },
    methods: {
        deleteGym(id) {
            axios
                .delete("/api/settings/gym_info/" + id)
                .then(response => {
                    this.gyms.slice(id, 1);
                    this.$router.go({
                        path: this.$router.currentRoute.path,
                        force: true
                    });
                })
                .catch(error => {
                    this.errorMessage = "削除に失敗しました。";
                    console.log(error);
                });
        }
    }
};
</script>
