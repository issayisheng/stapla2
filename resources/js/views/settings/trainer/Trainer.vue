<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        トレーナー管理
                    </div>
                    <div class="card-body">
                        <template v-if="trainers.length == 0">
                            <div class="text-center mb-3">
                                現在、所属トレーナーはいません
                            </div>
                        </template>
                        <template v-else>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>氏名</th>
                                        <th>電話番号</th>
                                        <th>メールアドレス</th>
                                        <th>ステータス</th>
                                        <th>承認ボタン</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(trainer, index) in trainers"
                                        :key="trainer.id"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ trainer.name }}</td>
                                        <td>{{ trainer.tel }}</td>
                                        <td>{{ trainer.email }}</td>

                                        <td
                                            v-if="trainer.status == 10"
                                            class="alert alert-success text-center"
                                        >
                                            オーナー
                                        </td>
                                        <td
                                            v-if="trainer.status == 5"
                                            class="alert alert-primary text-center"
                                        >
                                            承認済み
                                        </td>
                                        <td
                                            v-if="trainer.status == 0"
                                            class="alert alert-danger text-center"
                                        >
                                            未承認
                                        </td>
                                        <td>
                                            <router-link
                                                :to="
                                                    `/settings/trainer/${trainer.id}/edit`
                                                "
                                                class="btn btn-outline-secondary"
                                                >編集する</router-link
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </template>
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
            trainers: {}
        };
    },
    created() {
        axios
            .get("/api/settings/trainer")
            .then(response => {
                this.trainers = response.data;
            })
            .catch(error => {
                console.log(error);
            });
    }
};
</script>
