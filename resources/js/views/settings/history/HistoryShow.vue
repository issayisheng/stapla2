<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">購入に関するお問い合わせ</div>
                    <div class="card-body">
                        <div class="col-md-8 mx-auto">
                            <form>
                                <div class="form-group">
                                    <label>購入日</label>
                                    <input
                                        class="form-control"
                                        readonly
                                        type="text"
                                        :placeholder="info.created_at | moment"
                                    />
                                </div>
                                <div class="form-group">
                                    <label>チケット枚数</label>
                                    <input
                                        class="form-control"
                                        readonly
                                        type="text"
                                        :placeholder="info.order + '枚'"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="textarea"
                                        >お問い合わせ内容<span
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
                                        placeholder="こちらにお問い合わせ内容を入力してください。"
                                        @change="onChangeReason"
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
                                        問い合せする
                                    </button>
                                </div>
                                <div class="cancel-modal">
                                    <MyModal @close="closeModal" v-if="modal">
                                        <div class="col-11 mx-auto">
                                            <p class="text-center">
                                                以下の内容で問い合せします。
                                            </p>
                                            <div
                                                class="border p-3 border-3 mb-3"
                                            >
                                                <dl class="row text-left">
                                                    <dt class="col-4 col-md-3">
                                                        購入日
                                                    </dt>
                                                    <dd class="col-8 col-md-9">
                                                        {{
                                                            info.created_at
                                                                | moment
                                                        }}
                                                    </dd>
                                                </dl>
                                                <dl class="row text-left">
                                                    <dt class="col-4 col-md-3">
                                                        チケット枚数
                                                    </dt>
                                                    <dd class="col-8 col-md-9">
                                                        {{ info.order }}
                                                    </dd>
                                                </dl>
                                                <dl class="row text-left">
                                                    <dt class="col-4 col-md-3">
                                                        お問い合わせ理由
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
                                                    送信する
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
            errors: {},
            form: {
                reason: ""
            }
        };
    },
    created() {
        axios
            .get("/api/settings/history/" + this.id)
            .then(response => {
                this.info = response.data;
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
                .post("/api/settings/history/contact/" + this.id, data)
                .then(response => {
                    this.$router.push({
                        name: "history"
                    });
                    this.flash("お問い合わせ完了しました", "success", {
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
                });
        },
        onChangeReason: function(value) {
            if (value === "") {
                this.errors.reason = "お問い合わせ内容は必ず指定してください。";
            } else {
                this.errors.reason = "";
            }
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
