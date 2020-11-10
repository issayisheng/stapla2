<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-md-flex justify-content-between">
                        <div>チケット履歴</div>
                        <div>
                            <span v-if="ticket.length == 0">
                                現在、チケットは
                                <span class="font-weight-bold text-danger"
                                    >0</span
                                >枚です
                            </span>
                            <span v-else>
                                現在、チケットは
                                <span class="font-weight-bold text-danger">{{
                                    ticket.quantity
                                }}</span
                                >枚です
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <template v-if="histories.length == 0">
                            <div class="text-center mb-3">
                                チケット履歴はありません
                            </div>
                        </template>
                        <template v-else>
                            <div class="text-left mb-3">
                                全 {{ total }} 件中 {{ from }} 〜
                                {{ to }} 件表示
                            </div>
                            <div class="table-responsive">
                                <table
                                    class="table table-striped history-table"
                                >
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-nowrap">
                                                No
                                            </th>
                                            <th scope="col" class="text-nowrap">
                                                概要
                                            </th>
                                            <th scope="col" class="text-nowrap">
                                                枚数
                                            </th>
                                            <th scope="col" class="text-nowrap">
                                                購入に関するお問い合わせ
                                            </th>
                                            <th scope="col" class="text-nowrap">
                                                購入日
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(history,
                                            index) in histories"
                                            :key="history.id"
                                        >
                                            <th scope="row" class="text-nowrap">
                                                {{ index + 1 }}
                                            </th>
                                            <td scope="row" class="text-nowrap">
                                                {{ history.description }}
                                            </td>
                                            <td
                                                scope="row"
                                                class="text-nowrap text-center"
                                            >
                                                {{ history.order }}
                                            </td>
                                            <td
                                                v-if="history.status == 5"
                                                scope="row"
                                            >
                                                <router-link
                                                    class="btn btn-outline-danger text-nowrap"
                                                    :to="{
                                                        name: 'history_show',
                                                        params: {
                                                            id: history.id
                                                        }
                                                    }"
                                                >
                                                    お問い合わせ
                                                </router-link>
                                            </td>
                                            <td
                                                v-else-if="history.status == 10"
                                                scope="row"
                                            >
                                                <h5
                                                    class="badge badge-secondary badge-pill py-2"
                                                >
                                                    お問い合わせ済
                                                </h5>
                                            </td>
                                            <td v-else scope="row"></td>
                                            <td scope="row" class="text-nowrap">
                                                {{
                                                    history.created_at | moment
                                                }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <nav aria-label="Page navigation" class="pt-3">
                                <ul
                                    class="pagination justify-content-center pagination-md"
                                >
                                    <li
                                        :class="{
                                            disabled: current_page <= 1
                                        }"
                                    >
                                        <a
                                            class="page-link"
                                            href="#"
                                            @click="change(1)"
                                            >&laquo;</a
                                        >
                                    </li>
                                    <li
                                        :class="{
                                            disabled: current_page <= 1
                                        }"
                                    >
                                        <a
                                            class="page-link"
                                            href="#"
                                            @click="change(current_page - 1)"
                                            >&lt;</a
                                        >
                                    </li>
                                    <li
                                        v-for="page in pages"
                                        :key="page"
                                        class="page-item"
                                        :class="{
                                            active: page === current_page
                                        }"
                                    >
                                        <a
                                            class="page-link"
                                            href="#"
                                            @click="change(page)"
                                            >{{ page }}</a
                                        >
                                    </li>
                                    <li
                                        class="page-item"
                                        :class="{
                                            disabled: current_page >= last_page
                                        }"
                                    >
                                        <a
                                            class="page-link"
                                            href="#"
                                            @click="change(current_page + 1)"
                                            >&gt;</a
                                        >
                                    </li>
                                    <li
                                        class="page-item"
                                        :class="{
                                            disabled: current_page >= last_page
                                        }"
                                    >
                                        <a
                                            class="page-link"
                                            href="#"
                                            @click="change(last_page)"
                                            >&raquo;</a
                                        >
                                    </li>
                                </ul>
                            </nav>
                        </template>
                        <div class="row justify-content-center">
                            <router-link
                                to="/settings/ticket"
                                class="btn btn-outline-secondary mr-3"
                            >
                                チケット購入
                            </router-link>
                            <router-link
                                to="/reserve"
                                class="btn btn-outline-primary"
                            >
                                予約画面
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
            histories: {},
            ticket: {},
            current_page: 1,
            last_page: 1,
            total: 1,
            from: 0,
            to: 0
        };
    },
    mounted() {
        this.load(1);
    },
    created() {
        axios
            .get("/api/settings/history")
            .then(response => {
                this.ticket = response.data.ticket;
            })
            .catch(error => {
                console.log(error);
            });
    },
    methods: {
        load(page) {
            axios.get("/api/settings/history?page=" + page).then(({ data }) => {
                this.histories = data.history.data;
                this.current_page = data.history.current_page;
                this.last_page = data.history.last_page;
                this.total = data.history.total;
                this.from = data.history.from;
                this.to = data.history.to;
            });
        },
        change(page) {
            if (page >= 1 && page <= this.last_page) this.load(page);
        }
    },
    computed: {
        pages() {
            let start = _.max([this.current_page - 2, 1]);
            let end = _.min([start + 5, this.last_page + 1]);
            start = _.max([end - 5, 1]);
            return _.range(start, end);
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

<style scoped>
.history-table th,
.history-table td {
    vertical-align: middle;
}
</style>
