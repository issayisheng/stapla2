<template>
    <!-- @if (session('completed'))
    <div class="">
        <p>{{ session("done") }}</p>
    </div>
    @endif -->

    <!-- "Mon Opening Hour": "月曜日", "Tue
    Opening Hour": "火曜日", "Wed Opening Hour": "水曜日", "Thu Opening Hour":
    "木曜日", "Fri Opening Hour": "金曜日", "Sat Opening Hour": "土曜日", "Sun
    Opening Hour": "日曜日" -->

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">ジム詳細ページ</div>
                    <div class="layout-form py-5">
                        <div class="form-group">
                            <label for="gym_name" class="font-weight-bold"
                                >施設名</label
                            >
                            <p>{{ gym.name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="gym_address" class="font-weight-bold"
                                >郵便番号</label
                            >
                            <p>{{ gym.zipcode }}</p>
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
                                {{ gym.facility }}
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
                        <!-- <div class="form-group">
                        <label for="" class="font-weight-bold"
                            >ジム開放時間</label
                        >
                    </div> -->
                        <!-- @if ((isset(gym.mon_opening_started) &&
                    isset(gym.mon_opening_ended)) ||
                    (isset(gym.tue_opening_started) &&
                    isset(gym.tue_opening_ended)) ||
                    (isset(gym.wed_opening_started) &&
                    isset(gym.wed_opening_ended)) ||
                    (isset(gym.thu_opening_started) &&
                    isset(gym.thu_opening_ended)) ||
                    (isset(gym.fri_opening_started) &&
                    isset(gym.fri_opening_ended)) ||
                    (isset(gym.sat_opening_started) &&
                    isset(gym.sat_opening_ended)) ||
                    (isset(gym.sun_opening_started) &&
                    isset(gym.sun_opening_ended))) -->
                        <div class="form-group">
                            <label
                                for="mon_opening_hour"
                                class="font-weight-bold"
                                >{{ "Mon Opening Hour" }}</label
                            >
                            <!-- @if(isset(gym.mon_opening_started) &&
                        isset(gym.mon_opening_ended))
                        <p>
                            {{ gym.mon_opening_started }} ~
                            {{ gym.mon_opening_ended }}
                        </p>
                        @else
                        <p>Close</p>
                        @endif -->
                        </div>
                        <div class="form-group">
                            <label
                                for="tue_opening_hour"
                                class="font-weight-bold"
                                >{{ "Tue Opening Hour" }}</label
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
                                >{{ "Wed Opening Hour" }}</label
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
                                >{{ "Thu Opening Hour" }}</label
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
                                >{{ "Fri Opening Hour" }}</label
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
                                >{{ "Sat Opening Hour" }}</label
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
                                >{{ "Sun Opening Hour" }}</label
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
                        <!-- @else -->
                        <p>詳細はオーナにお問い合わせください。</p>
                        <!-- @endif -->

                        <div class="col-md-8 offset-md-2">
                            <!-- @if(gym.owner_id === $current_user->id) -->
                            <router-link
                                :to="{
                                    name: 'gyminfo_edit',
                                    params: { id: gym.id }
                                }"
                                class="btn btn-primary btn-block mb-3"
                                >編集</router-link
                            >
                            <!-- @endif -->
                            <router-link
                                to="/settings/gym_info"
                                class="btn btn-secondary btn-block"
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
            gym: []
        };
    },
    created() {
        axios
            .get("/api/settings/gym_info/" + this.id)
            .then(response => {
                this.gym = response.data;
                // console.log(response.data);
            })
            .catch(error => {
                console.log(error);
            });
    }
};
</script>

<style></style>
