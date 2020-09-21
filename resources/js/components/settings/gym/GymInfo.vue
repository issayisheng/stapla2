<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        ジム管理ページ
                        <router-link
                            to="/settings/gym_info/create"
                            class="btn btn-danger float-right"
                        >
                            ジム追加登録
                        </router-link>
                    </div>
                    <div class="card-body">
                        <div v-if="errorMessage" class="alert alert-danger">
                            {{ errorMessage }}
                        </div>
                        <div class="card-group">
                            <!-- @foreach($gyms as $gym) @if($gym->owner_id ===
                            Auth::user()->id) -->
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
                                    <!-- alt="{{ gym.name }}" -->
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{ gym.name }}
                                        </h5>
                                        <div class="text-center">
                                            <router-link
                                                :to="{
                                                    name: 'gyminfo_show',
                                                    params: { id: gym.id }
                                                }"
                                                class="btn btn-outline-primary"
                                            >
                                                詳細をみる
                                            </router-link>
                                        </div>
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
                console.log("error");
                this.errorMessage = "データの取得に失敗しました。";
            });
    }
};
</script>

<style></style>
