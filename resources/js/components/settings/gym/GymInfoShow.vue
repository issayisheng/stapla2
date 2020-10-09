<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ジム詳細ページ</div>
                    <div class="layout-form py-5 col-12">
                        <div class="form-group">
                            <div class="font-weight-bold title-class">
                                施設名
                            </div>
                            <div>{{ gym.name }}</div>
                        </div>
                        <div class="form-group">
                            <label for="gym_address" class="font-weight-bold"
                                >郵便番号</label
                            >
                            <div>{{ gym.zipcode }}</div>
                        </div>
                        <div class="form-group">
                            <label for="gym_address" class="font-weight-bold"
                                >住所</label
                            >
                            <div>{{ gym.address }}</div>
                        </div>
                        <div class="form-group">
                            <label for="gym_address" class="font-weight-bold"
                                >建物名</label
                            >
                            <div>{{ gym.building }}</div>
                        </div>
                        <div class="form-group">
                            <label for="gym_tel" class="font-weight-bold"
                                >電話番号</label
                            >
                            <div v-if="gym.tel == null">
                                登録されていません
                            </div>
                            <div v-else>
                                {{ gym.tel }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gym_facility" class="font-weight-bold"
                                >設備</label
                            >
                            <div v-if="gym.facility == null">
                                詳細はオーナにお問い合わせください。
                            </div>
                            <div v-else>
                                <span class="badge badge-secondary p-2">{{
                                    gym.facility
                                }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gym_tel" class="font-weight-bold"
                                >紹介用写真</label
                            >
                            <div v-if="gym.introduction_pic == null">
                                紹介用写真が設定されていません
                            </div>
                            <div v-else>
                                <!-- src="{{ env('AWS_URL').gym.introduction_pic }}" -->
                                <img
                                    class="card-img-top"
                                    :src="gym.introduction_pic"
                                />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gym_tel" class="font-weight-bold"
                                >紹介用テキスト</label
                            >
                            <div v-if="gym.introduction_text == null">
                                紹介用テキストが設定されていません
                            </div>
                            <div v-else>
                                {{ gym.introduction_text }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="font-weight-bold"
                                >ジム開放時間</label
                            >
                        </div>
                        <div class="form-group">
                            <label
                                for="mon_opening_hour"
                                class="font-weight-bold"
                                >月曜日</label
                            >
                            <div v-if="gym.mon_open && gym.mon_close">
                                {{ gym.mon_open }} ~
                                {{ gym.mon_close }}
                            </div>
                            <div v-else>Close</div>
                        </div>
                        <div class="form-group">
                            <label
                                for="tue_opening_hour"
                                class="font-weight-bold"
                                >火曜日</label
                            >
                            <!-- @if(isset(gym.tue_opening_started) &&
                        isset(gym.tue_opening_ended))
                        <p>
                            {{ gym.tue_opening_started }} ~
                            {{ gym.tue_opening_ended }}
                        </p>
                        @else
                        <p>Close</p>
                        @endif -->
                        </div>
                        <div class="form-group">
                            <label
                                for="wed_opening_hour"
                                class="font-weight-bold"
                                >水曜日</label
                            >
                            <!-- @if(isset(gym.wed_opening_started) &&
                        isset(gym.wed_opening_ended))
                        <p>
                            {{ gym.wed_opening_started }} ~
                            {{ gym.wed_opening_ended }}
                        </p>
                        @else
                        <p>Close</p>
                        @endif -->
                        </div>
                        <div class="form-group">
                            <label
                                for="thu_opening_hour"
                                class="font-weight-bold"
                                >木曜日</label
                            >
                            <!-- @if(isset(gym.thu_opening_started) &&
                        isset(gym.thu_opening_ended))
                        <p>
                            {{ gym.thu_opening_started }} ~
                            {{ gym.thu_opening_ended }}
                        </p>
                        @else
                        <p>Close</p>
                        @endif -->
                        </div>
                        <div class="form-group">
                            <label
                                for="fri_opening_hour"
                                class="font-weight-bold"
                                >金曜日</label
                            >
                            <!-- @if(isset(gym.fri_opening_started) &&
                        isset(gym.fri_opening_ended))
                        <p>
                            {{ gym.fri_opening_started }} ~
                            {{ gym.fri_opening_ended }}
                        </p>
                        @else
                        <p>Close</p>
                        @endif -->
                        </div>
                        <div class="form-group">
                            <label
                                for="sat_opening_hour"
                                class="font-weight-bold"
                                >土曜日</label
                            >
                            <!-- @if(isset(gym.sat_opening_started) &&
                        isset(gym.sat_opening_ended))
                        <p>
                            {{ gym.sat_opening_started }} ~
                            {{ gym.sat_opening_ended }}
                        </p>
                        @else
                        <p>Close</p>
                        @endif -->
                        </div>
                        <div class="form-group">
                            <label
                                for="sun_opening_hour"
                                class="font-weight-bold"
                                >日曜日</label
                            >
                            <!-- @if(isset(gym.sun_opening_started) &&
                        isset(gym.sun_opening_ended))
                        <p>
                            {{ gym.sun_opening_started }} ~
                            {{ gym.sun_opening_ended }}
                        </p>
                        @else
                        <p>Close</p>
                        @endif -->
                        </div>
                        <div class="col-md-10 offset-md-2">
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
    padding: 14px 15px;
}
</style>
