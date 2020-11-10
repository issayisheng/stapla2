<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">予約取り消し</div>
                    <div class="card-body">
                        <div class="col-md-8 mx-auto">
                            <form>
                                <div class="form-group">
                                    <label>施設名</label>
                                    <input
                                        class="form-control"
                                        readonly
                                        type="text"
                                        :placeholder="gyms.name"
                                    />
                                </div>
                                <div class="form-group">
                                    <label>予約日程</label>
                                    <input
                                        class="form-control"
                                        readonly
                                        type="text"
                                        :placeholder="info.date | moment"
                                    />
                                </div>
                                <div class="form-group">
                                    <label>時間</label>
                                    <input
                                        class="form-control"
                                        readonly
                                        type="text"
                                        :placeholder="info.time | reserveTime"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="textarea"
                                        >キャンセル理由<span
                                            class="badge badge-danger p-1 ml-1"
                                            >必須</span
                                        ></label
                                    >
                                    <textarea
                                        id="textarea"
                                        name="reason"
                                        class="form-control"
                                        :class="{
                                            'is-invalid': errors.reason
                                        }"
                                        cols="30"
                                        rows="5"
                                        v-model="form.reason"
                                        placeholder="こちらにキャンセル理由を入力してください。"
                                        @change="onChangeTextarea"
                                    ></textarea>
                                    <span
                                        class="invalid-feedback"
                                        role="alert"
                                        v-if="errors.reason"
                                    >
                                        <strong v-text="errors.reason"></strong
                                    ></span>
                                </div>
                                <div class="text-center">
                                    <button
                                        class="btn btn-outline-secondary"
                                        type="submit"
                                        @click.prevent="back"
                                    >
                                        戻る
                                    </button>
                                    <button
                                        class="btn btn-outline-danger"
                                        @click.prevent="openModal"
                                    >
                                        確認する
                                    </button>
                                </div>
                                <div class="cancel-modal">
                                    <MyModal @close="closeModal" v-if="modal">
                                        <div class="col-11 mx-auto">
                                            <p class="text-center">
                                                以下の内容でキャンセルします。
                                            </p>
                                            <div
                                                class="border p-3 border-3 mb-3"
                                            >
                                                <dl class="row text-left">
                                                    <dt class="col-4 col-md-3">
                                                        場所
                                                    </dt>
                                                    <dd class="col-8 col-md-9">
                                                        {{ gyms.name }}
                                                    </dd>
                                                </dl>
                                                <dl class="row text-left">
                                                    <dt class="col-4 col-md-3">
                                                        日時
                                                    </dt>
                                                    <dd class="col-8 col-md-9">
                                                        {{ info.date | moment }}
                                                        {{
                                                            info.time
                                                                | reserveTime
                                                        }}
                                                    </dd>
                                                </dl>
                                                <dl class="row text-left">
                                                    <dt class="col-4 col-md-3">
                                                        キャンセル理由
                                                    </dt>
                                                    <dd
                                                        class="col-8 col-md-9"
                                                        v-html="
                                                            nl2br(form.reason)
                                                        "
                                                    ></dd>
                                                </dl>
                                            </div>
                                            <div
                                                class="card border-danger mb-3"
                                            >
                                                <p
                                                    class="card-header bg-danger text-white"
                                                >
                                                    注意事項
                                                </p>
                                                <div class="card-body">
                                                    <ul>
                                                        <li>
                                                            キャンセルは前日23:59までとなり、それ以降は予約チケット消化となります。
                                                        </li>
                                                        <li>
                                                            予約の仮押さえは禁止しています。<br />キャンセルがあまりに多い場合は、別途チケットを徴収させていただく場合があります。
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mx-auto">
                                                <button
                                                    class="btn btn-outline-danger d-block w-100 mb-3"
                                                    @click.prevent="submit"
                                                >
                                                    キャンセルする
                                                </button>
                                                <button
                                                    class="btn btn-outline-secondary d-block w-100"
                                                    @click="closeModal"
                                                >
                                                    戻る
                                                </button>
                                            </div>
                                        </div>
                                    </MyModal>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
import MyModal from "../../../components/Modal.vue";

export default {
    components: { MyModal },
    data() {
        return {
            modal: false,
            id: this.$route.params.id,
            info: {},
            gyms: {},
            errors: {},
            form: {
                reason: ""
            }
        };
    },
    created() {
        axios
            .get("/api/settings/reservation/" + this.id)
            .then(response => {
                this.info = response.data;
                this.gyms = response.data.gyms;
            })
            .catch(error => {
                let errors = {};
                for (var key in error.response.data.errors) {
                    errors[key] = error.response.data.errors[key][0];
                }
                this.errors = errors;
                console.log(error);
            });
    },
    methods: {
        back() {
            this.$router.back(); // 1つ前へ
        },
        openModal() {
            this.modal = true;
        },
        closeModal() {
            this.modal = false;
        },
        nl2br: function(s) {
            return s.replace(/\n/g, "<br/>");
        },
        submit() {
            var self = this;
            this.errors = {};
            const data = {
                reason: this.form.reason
            };
            axios
                .post("/api/settings/reservation/contact/" + this.id, data)
                .then(response => {
                    this.$router.push({
                        name: "reservation"
                    });
                    this.flash("キャンセルしました", "error", {
                        timeout: 3000
                    });
                })
                .catch(error => {
                    this.modal = false;
                    var errors = {};
                    for (var key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    self.errors = errors;
                    console.log(error);
                });
        },
        onChangeTextarea: function(value) {
            if (value === "") {
                this.errors.reason = "キャンセル理由を入力して下さい。";
            } else {
                this.errors.reason = "";
            }
        }
    },
    filters: {
        moment: function(date) {
            moment.locale("ja");
            const momentDate = String(moment(date).format("llll")).slice(0, -6);
            return momentDate;
        },
        reserveTime: function(time) {
            return (time || "").slice(0, 5);
        },
        getEndTime: function(time) {
            const targetHour = Number(time[1]);
            const targetMinute = Number(time[3]);
            const moveUp = targetMinute == 0 ? 1 : 2;
            const endMinute = targetMinute == 0 ? 3 : 0;
            const calcHour = Number(targetHour + moveUp);
            const endHour =
                calcHour == 10
                    ? calcHour
                    : calcHour == 11
                    ? calcHour + 10
                    : time[0] + String(calcHour);
            return String(endHour) + ":" + String(endMinute) + time[4];
        }
    }
};
</script>

<style>
.border-3 {
    border: 3px solid #dee2e6 !important;
}
</style>
