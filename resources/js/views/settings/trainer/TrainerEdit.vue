<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">トレーナー管理(編集中)</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>電話番号</th>
                                    <th>メールアドレス</th>
                                    <th class="text-center" colspan="3">
                                        承認ボタン
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ trainer.name }}</td>
                                    <td>{{ trainer.tel }}</td>
                                    <td>{{ trainer.email }}</td>
                                    <td class="text-center">
                                        <button
                                            type="submit"
                                            class="btn btn-outline-primary"
                                            @click="submit('approval')"
                                        >
                                            承認する
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <form>
                                            <button
                                                type="submit"
                                                class="btn btn-outline-danger"
                                                @click="submit('disapproval')"
                                            >
                                                無効する
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <button
                                class="btn btn-outline-secondary"
                                @click.prevent="back"
                            >
                                戻る
                            </button>
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
            trainer: {}
        };
    },
    created() {
        axios
            .get("/api/settings/trainer/" + this.id)
            .then(response => {
                this.trainer = response.data;
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
                .then(response => {})
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
    }
};
</script>

<style></style>
