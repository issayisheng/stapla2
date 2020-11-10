<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ジム登録(編集中)</div>
                    <form
                        enctype="multipart/form-data"
                        @submit.prevent="updateGym"
                        class="col-md-6 mx-auto py-5"
                    >
                        <div v-if="errorMessage" class="alert alert-danger">
                            {{ errorMessage }}
                        </div>
                        <div class="form-group">
                            <label for="gym_name" class="font-weight-bold"
                                >施設名<span
                                    class="badge badge-danger p-1 ml-1 align-middle"
                                    >必須</span
                                ></label
                            >
                            <input
                                id="gym_name"
                                type="text"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.gym_name
                                }"
                                name="gym_name"
                                placeholder="例）PAL烏丸御池"
                                v-model="gym.name"
                            />
                            <span
                                class="invalid-feedback"
                                role="alert"
                                v-if="errors.gym_name"
                            >
                                <strong v-text="errors.gym_name"></strong
                            ></span>
                        </div>
                        <div class="form-group">
                            <label for="gym_zipcode" class="font-weight-bold"
                                >郵便番号<span
                                    class="badge badge-danger p-1 ml-1 align-middle"
                                    >必須</span
                                ></label
                            >
                            <input
                                id="gym_zipcode"
                                type="text"
                                maxlength="7"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.gym_zipcode
                                }"
                                name="gym_zipcode"
                                placeholder="例）6040042"
                                v-model="gym.zipcode"
                            />
                            <span
                                class="invalid-feedback"
                                role="alert"
                                v-if="errors.gym_zipcode"
                            >
                                <strong v-text="errors.gym_zipcode"></strong
                            ></span>
                            <p class="form-group-text">
                                ※ハイフン抜き、半角数字で入力してください。
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="gym_address" class="font-weight-bold"
                                >住所<span
                                    class="badge badge-danger p-1 ml-1 align-middle"
                                    >必須</span
                                ></label
                            >
                            <input
                                id="gym_address"
                                type="text"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.gym_address
                                }"
                                name="gym_address"
                                placeholder="例）京都市中京区押西洞院町590-5"
                                v-model="gym.address"
                            />
                            <span
                                class="invalid-feedback"
                                role="alert"
                                v-if="errors.gym_address"
                            >
                                <strong v-text="errors.gym_address"></strong
                            ></span>
                        </div>
                        <div class="form-group">
                            <label for="gym_building" class="font-weight-bold"
                                >建物名<span
                                    class="badge badge-secondary p-1 ml-1 align-middle"
                                    >任意</span
                                ></label
                            >
                            <input
                                id="gym_building"
                                type="text"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.gym_building
                                }"
                                name="gym_building"
                                placeholder="例）ライフプラザ烏丸御池302"
                                v-model="gym.building"
                            />
                            <span
                                class="invalid-feedback"
                                role="alert"
                                v-if="errors.gym_building"
                            >
                                <strong v-text="errors.gym_building"></strong
                            ></span>
                        </div>
                        <div class="form-group">
                            <label for="gym_tel" class="font-weight-bold"
                                >電話番号<span
                                    class="badge badge-secondary p-1 ml-1 align-middle"
                                    >任意</span
                                ></label
                            >
                            <input
                                id="gym_tel"
                                type="tel"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.gym_tel
                                }"
                                name="gym_tel"
                                placeholder="例）08012345678"
                                v-model="gym.tel"
                            />
                            <span
                                class="invalid-feedback"
                                role="alert"
                                v-if="errors.gym_tel"
                            >
                                <strong v-text="errors.gym_tel"></strong
                            ></span>
                        </div>
                        <div class="form-group">
                            <label
                                for="introduction_pic"
                                class="font-weight-bold"
                                >紹介用写真<span
                                    class="badge badge-secondary p-1 ml-1 align-middle"
                                    >任意</span
                                ></label
                            >
                            <div class="custom-file">
                                <input
                                    id="introduction_pic"
                                    type="file"
                                    class="custom-file-input"
                                    :class="{
                                        'is-invalid': errors.introduction_pic
                                    }"
                                    name="introduction_pic"
                                    placeholder=""
                                />
                                <label
                                    class="custom-file-label"
                                    for="inputFile"
                                    data-browse="参照"
                                    >ファイルを選択</label
                                >
                            </div>
                            <span
                                class="invalid-feedback"
                                role="alert"
                                v-if="errors.introduction_pic"
                            >
                                <strong
                                    v-text="errors.introduction_pic"
                                ></strong
                            ></span>
                        </div>
                        <div class="form-group">
                            <label
                                for="introduction_text"
                                class="font-weight-bold"
                                >紹介用テキスト<span
                                    class="badge badge-secondary p-1 ml-1 align-middle"
                                    >任意</span
                                ></label
                            >
                            <textarea
                                id="introduction_text"
                                type="text"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.introduction_text
                                }"
                                name="introduction_text"
                                placeholder=""
                                v-model="gym.introduction_text"
                            ></textarea>
                            <span
                                class="invalid-feedback"
                                role="alert"
                                v-if="errors.introduction_text"
                            >
                                <strong
                                    v-text="errors.introduction_text"
                                ></strong
                            ></span>
                        </div>
                        <div class="form-group">
                            <label for="gym_facility" class="font-weight-bold"
                                >設備<span
                                    class="badge badge-secondary p-1 ml-1 align-middle"
                                    >任意</span
                                ></label
                            >
                            <input
                                id="gym_facility"
                                type="text"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.gym_facility
                                }"
                                name="gym_facility"
                                placeholder=""
                                v-model="gym.facility"
                            />
                            <span
                                class="invalid-feedback"
                                role="alert"
                                v-if="errors.gym_facility"
                            >
                                <strong v-text="errors.gym_facility"></strong
                            ></span>
                        </div>
                        <!-- <div class="form-group">
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
                            <input
                                id="mon_opening_hour"
                                type="time"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.mon_open
                                }"
                                name="mon_open"
                                v-model="gym.mon_open"
                                placeholder=""
                            />
                            <input
                                id="mon_opening_hour"
                                type="time"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.mon_close
                                }"
                                name="mon_close"
                                v-model="gym.mon_close"
                                placeholder=""
                            />
                            <span
                                class="invalid-feedback"
                                role="alert"
                                v-if="errors.mon_open"
                            >
                                <strong v-text="errors.mon_open"></strong
                            ></span>
                            <span
                                class="invalid-feedback"
                                role="alert"
                                v-if="errors.mon_open"
                            >
                                <strong v-text="errors.mon_open"></strong
                            ></span>
                        </div> -->
                        <div class="text-center">
                            <button
                                type="submit"
                                class="btn btn-outline-primary"
                            >
                                更新
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    data() {
        return {
            id: this.$route.params.id,
            gym: {
                name: "",
                zipcode: "",
                address: "",
                building: "",
                tel: "",
                // introduction_pic: "",
                introduction_text: "",
                facility: "",
                mon_open: "",
                mon_close: ""
            },
            errors: {},
            errorMessage: ""
        };
    },
    computed: {
        ...mapGetters({
            user: "auth/user"
        })
    },
    created: function() {
        axios
            .get("/api/settings/gym_info/" + this.id)
            .then(response => {
                this.gym = response.data;
            })
            .catch(error => {
                this.errorMessage = "データの取得に失敗しました。";
            });
    },
    methods: {
        updateGym: function() {
            this.errors = {};
            axios
                .put("/api/settings/gym_info/" + this.gym.id, {
                    gym_name: this.gym.name,
                    gym_zipcode: this.gym.zipcode,
                    gym_address: this.gym.address,
                    gym_building: this.gym.building,
                    gym_tel: this.gym.tel,
                    // introduction_pic: this.gym.introduction_pic,
                    introduction_text: this.gym.introduction_text,
                    gym_facility: this.gym.facility,
                    mon_open: this.gym.mon_open,
                    mon_close: this.gym.mon_close
                })
                .then(response => {
                    this.gym = response.data.gym;
                    this.$router.push({
                        name: "gyminfo_show",
                        params: { id: this.$route.params.id }
                    });
                })
                .catch(error => {
                    var errors = {};
                    for (var key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    this.errors = errors;
                    this.errorMessage = "入力内容に誤りがあります。";
                    console.log(error);
                });
        }
    },
    watch: {
        "gym.zipcode": function(val) {
            this.errors = {};
            let self = this;
            if (7 > val.length) {
                return;
            }
            axios
                .get(`/api/zipcode/?zipcode=${val}`)
                .then(response => {
                    self.gym.address = response.data.data.fullAddress;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
