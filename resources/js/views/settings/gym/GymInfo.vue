<template>
    <div class="container py-5">
        <div class="card mb-3">
            <div class="card-header">所有ジム予約一覧</div>
            <div class="card-body">
                <div v-if="message" class="alert alert-danger">
                    {{ message }}
                </div>
                <template v-if="items.length == 0">
                    <div class="mb-0">
                        現在、登録ジムに予約はありません。
                    </div>
                </template>
                <template v-else>
                    <div class="text-left mb-3">
                        全 {{ total }} 件中 {{ from }} 〜 {{ to }} 件表示
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
                                        予約時間
                                    </th>
                                    <th scope="col" class="text-nowrap">
                                        施設名
                                    </th>
                                    <th scope="col" class="text-nowrap">
                                        ユーザー名
                                    </th>
                                    <th scope="col" class="text-nowrap">
                                        状態
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
                                        {{ item.date | reserveDate }}
                                        ({{ item.day_name_ja }})
                                    </td>
                                    <td class="text-nowrap">
                                        {{ item.time | reserveTime }} 〜
                                        {{ item.time | getEndTime }}
                                    </td>
                                    <td
                                        class="text-nowrap"
                                        v-if="item.gyms !== null"
                                    >
                                        {{ item.gyms.name }}
                                    </td>
                                    <td class="text-nowrap">
                                        {{ item.users[0].name }}
                                    </td>
                                    <td v-if="item.status == '0'">
                                        -
                                    </td>
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
                                    <td class="text-nowrap">
                                        {{ item.updated_at | reserveDate }}
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
                    </div>
                </template>
            </div>
        </div>
        <div class="card">
            <div
                class="card-header d-flex justify-content-between align-items-center"
            >
                ジム管理
                <!-- <router-link
                            to="/settings/gym_info/create"
                            class="btn btn-success"
                        >
                            ジム追加登録
                        </router-link> -->
            </div>
            <div class="card-body">
                <div v-if="errorMessage" class="alert alert-danger">
                    {{ errorMessage }}
                </div>
                <div class="card-group text-center" v-if="gyms.length == 0">
                    現在登録されていません。
                </div>
                <div class="card-group" v-else>
                    <div
                        v-for="gym in gyms"
                        :key="gym.id"
                        class="col-sm-12 col-md-6 col-lg-4 px-0 px-md-3"
                    >
                        <div class="card mb-3">
                            <img
                                class="card-img-top"
                                :src="
                                    gym.introduction_pic
                                        ? '../' + gym.introduction_pic
                                        : noimage
                                "
                            />
                            <div class="card-body">
                                <h5 class="card-title mb-3">
                                    {{ gym.name }}
                                </h5>
                                <router-link
                                    :to="{
                                        name: 'gyminfo_show',
                                        params: { id: gym.id }
                                    }"
                                    class="btn btn-outline-primary d-block py-2"
                                >
                                    詳細をみる
                                </router-link>
                            </div>
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
            gyms: [],
            items: [],
            message: "",
            current_page: 1,
            last_page: 1,
            total: 1,
            from: 0,
            to: 0,
            noimage: "",
            errorMessage: ""
        };
    },
    mounted() {
        this.load(1);
    },
    created() {
        axios
            .get("/api/settings/gym_info")
            .then(response => {
                this.gyms = response.data;
                this.noimage = "/img/gym/noimage.png";
            })
            .catch(error => {
                console.log(error);
                this.errorMessage = "データの取得に失敗しました。";
            });
    },
    methods: {
        load(page) {
            axios.get("/api/get_reserve?page=" + page).then(({ data }) => {
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
        reserveDate: function(date) {
            moment.locale("ja");
            return moment(date).format("ll");
        },
        reserveTime: function(date) {
            return (date || "").slice(0, 5);
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
