<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">チケット購入履歴</div>
                    <div class="card-body">
                        <div v-if="items.length == 0" class="text-center mb-3">
                            購入履歴はありません
                        </div>
                        <table class="table table-striped" v-else>
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">購入日</th>
                                    <th scope="col">枚数</th>
                                    <th scope="col">お問い合わせ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in items"
                                    :key="item.id"
                                >
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{ item.created_at | moment }}</td>
                                    <td>{{ item.order }}</td>
                                    <td>
                                        <router-link
                                            class="btn btn-outline-success"
                                            v-bind:to="{
                                                name: 'history_show',
                                                params: { id: item.id }
                                            }"
                                        >
                                            購入に関する問い合わせ
                                        </router-link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row justify-content-center">
                            <router-link
                                to="/settings/ticket"
                                class="btn btn-outline-primary"
                            >
                                チケット購入
                            </router-link>
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
            items: []
        };
    },
    created() {
        axios
            .get("/api/settings/history")
            .then(response => {
                this.items = response.data;
            })
            .catch(error => {
                console.log("error");
            });
    },
    filters: {
        moment: function(date) {
            moment.locale("ja");
            return moment(date).format("lll");
        }
    }
};
</script>
