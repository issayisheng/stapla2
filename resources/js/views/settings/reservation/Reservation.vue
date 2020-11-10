<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">予約一覧</div>
                    <div class="card-body">
                        <div v-if="message" class="alert alert-danger">
                            {{ message }}
                        </div>
                        <template v-if="items.length == 0">
                            <div class="text-center mb-3">
                                現在、予約はありません。
                            </div>
                        </template>
                        <template v-else>
                            <div class="text-left mb-3">
                                全 {{ total }} 件中 {{ from }} 〜
                                {{ to }} 件表示
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-nowrap">
                                                No
                                            </th>
                                            <th scope="col" class="text-nowrap">
                                                予約日
                                            </th>
                                            <th scope="col" class="text-nowrap">
                                                施設予約時間
                                            </th>
                                            <th scope="col" class="text-nowrap">
                                                施設名
                                            </th>
                                            <th scope="col" class="text-nowrap">
                                                状態
                                            </th>
                                            <th scope="col" class="text-nowrap">
                                                予約取り消し
                                            </th>
                                            <th scope="col" class="text-nowrap">
                                                登録日
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(item, index) in items"
                                            :key="item.id"
                                        >
                                            <th scope="row">{{ index + 1 }}</th>
                                            <td class="text-nowrap">
                                                {{ item.date | moment }}
                                                ({{ item.day_name_ja }})
                                            </td>
                                            <td class="text-nowrap">
                                                {{ item.time | reserveTime }} 〜
                                                {{ item.time | getEndTime }}
                                            </td>
                                            <td class="text-nowrap">
                                                {{ item.gyms.name }}
                                            </td>
                                            <td v-if="item.status == '0'"></td>
                                            <td v-else-if="item.status == '1'">
                                                <h5
                                                    class="badge badge-primary badge-pill py-2 reservation-badge"
                                                >
                                                    予約済み
                                                </h5>
                                            </td>
                                            <td v-else-if="item.status == '2'">
                                                <h5
                                                    class="badge badge-secondary badge-pill py-2 reservation-badge"
                                                >
                                                    完了
                                                </h5>
                                            </td>
                                            <td v-else-if="item.status == '10'">
                                                <h5
                                                    class="badge badge-danger badge-pill py-2 reservation-badge"
                                                >
                                                    キャンセル済
                                                </h5>
                                            </td>
                                            <td v-if="item.status == '2'">-</td>
                                            <td v-else-if="item.status == '10'">
                                                -
                                            </td>
                                            <td v-else class="text-nowrap">
                                                <router-link
                                                    class="btn btn-outline-danger"
                                                    :to="
                                                        `/settings/reservation/${item.id}/`
                                                    "
                                                >
                                                    キャンセル
                                                </router-link>
                                            </td>
                                            <td class="text-nowrap">
                                                {{ item.updated_at | moment }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                                @click="
                                                    change(current_page - 1)
                                                "
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
                                                disabled:
                                                    current_page >= last_page
                                            }"
                                        >
                                            <a
                                                class="page-link"
                                                href="#"
                                                @click="
                                                    change(current_page + 1)
                                                "
                                                >&gt;</a
                                            >
                                        </li>
                                        <li
                                            class="page-item"
                                            :class="{
                                                disabled:
                                                    current_page >= last_page
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
                            </div>
                        </template>
                        <div class="col-10 mx-auto text-center">
                            <router-link
                                to="/reserve"
                                class="btn btn-outline-secondary"
                            >
                                予約画面
                            </router-link>
                            <router-link
                                to="/settings/history"
                                class="btn btn-outline-primary"
                            >
                                チケット履歴
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
            items: [],
            message: "",
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
            .get("/api/settings/reservation")
            .then(response => {})
            .catch(error => {
                this.message = "データの取得に失敗しました。";
            });
    },
    methods: {
        load(page) {
            axios
                .get("/api/settings/reservation?page=" + page)
                .then(({ data }) => {
                    this.items = data.calendar.data;
                    this.current_page = data.calendar.current_page;
                    this.last_page = data.calendar.last_page;
                    this.total = data.calendar.total;
                    this.from = data.calendar.from;
                    this.to = data.calendar.to;
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
.reservation-badge {
    max-width: 80px;
    width: 100%;
}
</style>
