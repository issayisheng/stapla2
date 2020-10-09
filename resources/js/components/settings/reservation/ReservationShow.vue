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
                                        :placeholder="info.time"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="textarea">キャンセル理由</label>
                                    <textarea
                                        name="textarea"
                                        class="form-control"
                                        :class="{
                                            'is-invalid': errors.textarea
                                        }"
                                        id="textarea"
                                        cols="30"
                                        rows="5"
                                        v-model="textarea"
                                        placeholder="こちらにキャンセル理由を入力してください。"
                                    ></textarea>
                                    <span
                                        class="invalid-feedback"
                                        role="alert"
                                        v-if="errors.textarea"
                                    >
                                        <strong
                                            v-text="errors.textarea"
                                        ></strong
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
                                        キャンセルする
                                    </button>
                                </div>
                                <div class="cancel-modal">
                                    <MyModal @close="closeModal" v-if="modal">
                                        <div class="col-11 mx-auto">
                                            <p class="text-center">
                                                以下の内容でキャンセル理由します。
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
                                                        {{ info.time }}
                                                    </dd>
                                                </dl>
                                                <dl class="row text-left">
                                                    <dt class="col-4 col-md-3">
                                                        キャンセル理由
                                                    </dt>
                                                    <dd class="col-8 col-md-9">
                                                        {{ textarea }}
                                                    </dd>
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
                                            <div class="col-md-6 mx-auto">
                                                <button
                                                    class="btn btn-outline-primary d-block w-100 mb-3"
                                                    @click.prevent="
                                                        submit(textarea)
                                                    "
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
import MyModal from "../../Modal.vue";

export default {
    components: { MyModal },
    data() {
        return {
            modal: false,
            id: this.$route.params.id,
            info: {},
            gyms: {},
            errors: {},
            textarea: "",
            message: ""
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
        submit() {
            this.errors = {};
            this.message = "";
            const data = {
                comment: textarea
            };
            var self = this;
            axios
                .post("/api/settings/reservation/contact/" + this.id, data)
                .then(response => {
                    this.$router.push({
                        name: "reservation"
                    });
                })
                .catch(error => {
                    this.modal = false;
                    var errors = {};
                    var message = "";
                    for (var key in error.response.data.errors) {
                        errors[key] = error.response.data.errors[key][0];
                    }
                    this.errors = errors;
                    console.log(error);
                });
        }
    },
    filters: {
        moment: function(date) {
            moment.locale("ja");
            return moment(date).format("ll");
        }
    }
};
</script>

<style>
.border-3 {
    border: 3px solid #dee2e6 !important;
}
</style>
