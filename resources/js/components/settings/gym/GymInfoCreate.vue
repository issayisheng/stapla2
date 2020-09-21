<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">ジム新規登録</div>

                    <form
                        class="layout-form py-5"
                        enctype="multipart/form-data"
                        @submit.prevent="createGym"
                    >
                        <div v-if="errorMessage" class="alert alert-danger">
                            {{ errorMessage }}
                        </div>
                        <div class="form-group">
                            <label for="gym_name" class="font-weight-bold"
                                >施設名<span class="badge badge-danger p-1 ml-1"
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
                                    class="badge badge-danger p-1 ml-1"
                                    >必須</span
                                ></label
                            >
                            <input
                                id="gym_zipcode"
                                type="text"
                                maxlength="8"
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
                                >住所<span class="badge badge-danger p-1 ml-1"
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
                                    class="badge badge-secondary p-1 ml-1"
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
                                    class="badge badge-secondary p-1 ml-1"
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
                                    class="badge badge-secondary p-1 ml-1"
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
                                    class="badge badge-secondary p-1 ml-1"
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
                                    class="badge badge-secondary p-1 ml-1"
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
                        </div> -->
                        <!-- <div class="form-group">
                            <label
                                for="mon_opening_hour"
                                class="font-weight-bold"
                                >{{ "Mon Opening Hour" }}</label
                            >
                            <input
                                id="mon_opening_hour"
                                type="time"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.mon_open
                                }"
                                name="mon_open"
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
                                v-if="errors.mon_close"
                            >
                                <strong v-text="errors.mon_close"></strong
                            ></span>
                        </div>
                        <div class="form-group">
                            <label
                                for="tue_opening_hour"
                                class="font-weight-bold"
                                >{{ "Tue Opening Hour" }}</label
                            >
                            <input
                                id="tue_opening_hour"
                                type="time"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.tue_open
                                }"
                                name="tue_open"
                                placeholder=""
                            />
                            <input
                                id="tue_opening_hour"
                                type="time"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.tue_close
                                }"
                                name="tue_close"
                                placeholder=""
                            />
                            @error('tue_open')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror @error('tue_close')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label
                                for="wed_opening_hour"
                                class="font-weight-bold"
                                >{{ "Wed Opening Hour" }}</label
                            >
                            <input
                                id="wed_opening_hour"
                                type="time"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.wed_open
                                }"
                                name="wed_open"
                                placeholder=""
                            />
                            <input
                                id="wed_opening_hour"
                                type="time"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.wed_close
                                }"
                                name="wed_close"
                                placeholder=""
                            />
                            @error('wed_open')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror @error('wed_close')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label
                                for="thu_opening_hour"
                                class="font-weight-bold"
                                >{{ "Thu Opening Hour" }}</label
                            >
                            <input
                                id="thu_opening_hour"
                                type="time"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.thu_open
                                }"
                                name="thu_open"
                                placeholder=""
                            />
                            <input
                                id="thu_opening_hour"
                                type="time"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.thu_close
                                }"
                                name="thu_close"
                                placeholder=""
                            />
                            @error('thu_open')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror @error('thu_close')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label
                                for="fri_opening_hour"
                                class="font-weight-bold"
                                >{{ "Fri Opening Hour" }}</label
                            >
                            <input
                                id="fri_opening_hour"
                                type="time"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.fri_open
                                }"
                                name="fri_open"
                                placeholder=""
                            />
                            <input
                                id="fri_opening_hour"
                                type="time"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.fri_close
                                }"
                                name="fri_close"
                                placeholder=""
                            />
                            @error('fri_open')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror @error('fri_close')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label
                                for="sat_opening_hour"
                                class="font-weight-bold"
                                >{{ "Sat Opening Hour" }}</label
                            >
                            <input
                                id="sat_opening_hour"
                                type="time"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.sat_open
                                }"
                                name="sat_open"
                                placeholder=""
                            />
                            <input
                                id="sat_opening_hour"
                                type="time"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.sat_close
                                }"
                                name="sat_close"
                                placeholder=""
                            />
                            @error('sat_open')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror @error('sat_close')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label
                                for="sun_opening_hour"
                                class="font-weight-bold"
                                >{{ "Sun Opening Hour" }}</label
                            >
                            <input
                                id="sun_opening_hour"
                                type="time"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.sun_open
                                }"
                                name="sun_open"
                                placeholder=""
                            />
                            <input
                                id="sun_opening_hour"
                                type="time"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.sun_close
                                }"
                                name="sun_close"
                                placeholder=""
                            />
                            @error('sun_open')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror @error('sun_close')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> -->
                        <button type="submit" class="btn btn-primary btn-block">
                            登録
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            gym: {
                name: "",
                zipcode: "",
                address: "",
                building: "",
                tel: "",
                introduction_text: "",
                facility: ""
            },
            errors: {},
            errorMessage: ""
        };
    },
    methods: {
        createGym: function() {
            this.errors = {};
            axios
                .post("/api/settings/gym_info", {
                    gym_name: this.gym.name,
                    gym_zipcode: this.gym.zipcode,
                    gym_address: this.gym.address,
                    gym_building: this.gym.building,
                    gym_tel: this.gym.tel,
                    // introduction_pic: this.gym.introduction_pic,
                    introduction_text: this.gym.introduction_text,
                    gym_facility: this.gym.facility
                })
                .then(response => {
                    // this.gym = response.data.gym;
                    this.$router.push({ name: "gym" });
                })
                .catch(error => {
                    var errors = {};
                    for (var key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    this.errors = errors;
                    // this.errorMessage = "入力内容に誤りがあります。";
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
                    // console.log(response.data);
                    self.gym.address = response.data.data.fullAddress;
                })
                .catch(error => {
                    this.errorMessage = error;
                    console.log(error);
                });
        }
    }
};
</script>
