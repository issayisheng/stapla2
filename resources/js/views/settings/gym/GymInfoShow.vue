<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ジム詳細ページ</div>
                    <div class="py-5 col-md-6 mx-auto">
                        <div class="card mb-2">
                            <div class="card-header">
                                施設名
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    {{ gym.name }}
                                </p>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">
                                郵便番号
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    {{ gym.zipcode }}
                                </p>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">
                                住所
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    {{ gym.address }}
                                </p>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">
                                建物名
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    {{ gym.building }}
                                </p>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">
                                電話番号
                            </div>
                            <div class="card-body">
                                <div v-if="gym.tel == null">
                                    登録されていません
                                </div>
                                <div v-else>
                                    {{ gym.tel }}
                                </div>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="card-header">
                                設備
                            </div>
                            <div class="card-body">
                                <div v-if="gym.facility == null">
                                    詳細はオーナにお問い合わせください。
                                </div>
                                <div v-else>
                                    <span class="badge badge-secondary p-2">{{
                                        gym.facility
                                    }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">
                                紹介用写真
                            </div>
                            <div class="card-body">
                                <div v-if="gym.introduction_pic == null">
                                    紹介用写真が設定されていません
                                </div>
                                <div v-else>
                                    <!-- src="{{ env('AWS_URL').gym.introduction_pic }}" -->
                                    <img
                                        class="card-img-top"
                                        :src="'/' + gym.introduction_pic"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">
                                紹介用テキスト
                            </div>
                            <div class="card-body">
                                <div v-if="gym.introduction_text == null">
                                    紹介用テキストが設定されていません
                                </div>
                                <div v-else>
                                    {{ gym.introduction_text }}
                                </div>
                            </div>
                        </div>
                        <!-- <div class="card mb-5">
                            <div class="card-header">
                                ジム開放時間
                            </div>
                            <div class="card-body">
                                <div>月曜日</div>
                                <div v-if="gym.mon_open && gym.mon_close">
                                    {{ gym.mon_open }} ~
                                    {{ gym.mon_close }}
                                </div>
                                <div v-else>Close</div>
                            </div>
                            <div class="card-body">
                                <div>火曜日</div>
                                <div v-if="gym.mon_open && gym.mon_close">
                                    {{ gym.mon_open }} ~
                                    {{ gym.mon_close }}
                                </div>
                                <div v-else>Close</div>
                            </div>
                        </div> -->
                        <div class="col-md-8 mx-auto">
                            <div class="d-flex mb-3">
                                <router-link
                                    :to="`/settings/gym_info/${gym.id}/edit`"
                                    class="btn btn-outline-primary btn-block mr-3"
                                    >編集する</router-link
                                >
                                <button
                                    class="btn btn-outline-danger d-block w-100"
                                    @click="deleteGym(gym.id)"
                                >
                                    削除する
                                </button>
                            </div>
                            <router-link
                                to="/settings/gym_info"
                                class="btn btn-outline-secondary btn-block"
                            >
                                ジム一覧へ
                            </router-link>
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
            id: this.$route.params.id,
            gym: {}
        };
    },
    created() {
        axios
            .get("/api/settings/gym_info/" + this.id)
            .then(response => {
                this.gym = response.data;
            })
            .catch(error => {
                console.log(error);
            });
    },
    methods: {
        deleteGym(id) {
            axios
                .delete("/api/settings/gym_info/" + this.id)
                .then(response => {
                    this.gyms.slice(this.id, 1);
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

<style>
.title-class {
    background-color: #f2f2f2;
    font-size: 16px;
    padding: 5px 15px;
}
</style>
