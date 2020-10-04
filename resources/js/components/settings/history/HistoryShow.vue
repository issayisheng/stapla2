<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">お問い合わせ</div>
                    <div class="card-body">
                        <div class="col-md-8 mx-auto">
                            <form @submit.prevent="submit">
                                <div class="form-group">
                                    <label>購入日</label>
                                    <input
                                        class="form-control"
                                        readonly
                                        type="text"
                                        :placeholder="items.created_at | moment"
                                    />
                                </div>
                                <div class="form-group">
                                    <label>チケット枚数</label>
                                    <input
                                        class="form-control"
                                        readonly
                                        type="text"
                                        :placeholder="items.order"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="textarea"
                                        >お問い合わせ内容</label
                                    >
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
                                        placeholder="こちらにお問い合わせ内容を入力してください。"
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
                                        class="btn btn-outline-success"
                                        type="submit"
                                    >
                                        送信する
                                    </button>
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

export default {
    data() {
        return {
            id: this.$route.params.id,
            items: {},
            errors: {},
            textarea: "",
            message: ""
        };
    },
    created() {
        axios
            .get("/api/settings/history/" + this.id)
            .then(response => {
                this.items = response.data;
                console.log(response);
            })
            .catch(error => {
                console.log(error);
            });
    },
    methods: {
        back() {
            this.$router.back(); // 1つ前へ
        },
        submit() {
            this.errors = {};
            this.message = "";
            var self = this;
            axios
                .post("/api/settings/history/contact")
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
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
            return moment(date).format("lll");
        }
    }
};
</script>
