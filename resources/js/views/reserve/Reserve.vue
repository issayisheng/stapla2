<template>
    <div class="container py-5">
        <template v-if="gyms.length !== 0">
            <div class="mb-3">
                全 {{ total }} 件中 {{ from }} 〜 {{ to }} 件表示
            </div>
            <div class="card-group">
                <div
                    v-for="gym in gyms"
                    :key="gym.id"
                    class="col-sm-12 col-md-6 col-lg-4 px-md-2 mb-3"
                >
                    <router-link
                        :to="{
                            name: 'reserve_show',
                            params: { id: gym.id }
                        }"
                        class="card mb-3"
                    >
                        <img
                            class="bd-placeholder-img bd-placeholder-img-lg card-img"
                            width="100%"
                            height="270"
                            :src="
                                gym.introduction_pic
                                    ? gym.introduction_pic
                                    : noimage
                            "
                        />
                        <div
                            class="card-img-overlay d-flex justify-content-center align-items-center text-center"
                        >
                            <h2 class="card-title text-white">
                                {{ gym.name }}
                            </h2>
                        </div>
                    </router-link>
                    <div>
                        <div>
                            <span
                                class="badge badge-secondary p-1 mr-2 align-middle"
                                >住所</span
                            >{{ gym.address }}
                        </div>
                        <div>
                            <span
                                class="badge badge-secondary p-1 mr-2 align-middle"
                                >設備</span
                            >{{ gym.facility }}
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="Page navigation" class="navigation">
                <ul class="pagination justify-content-center pagination-mg">
                    <li :class="{ disabled: current_page <= 1 }">
                        <a class="page-link" href="#" @click="change(1)"
                            >&laquo;</a
                        >
                    </li>
                    <li :class="{ disabled: current_page <= 1 }">
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
                        :class="{ active: page === current_page }"
                        class="page-item"
                    >
                        <a class="page-link" href="#" @click="change(page)">{{
                            page
                        }}</a>
                    </li>
                    <li
                        class="page-item"
                        :class="{ disabled: current_page >= last_page }"
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
                        :class="{ disabled: current_page >= last_page }"
                    >
                        <a class="page-link" href="#" @click="change(last_page)"
                            >&raquo;</a
                        >
                    </li>
                </ul>
            </nav>
        </template>
    </div>
</template>

<script>
export default {
    data() {
        return {
            gyms: [],
            noimage: "",
            errorMessage: "",
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
            .get("/api/reserve")
            .then(response => {
                this.gyms = response.data.data;
                this.noimage = "/img/gym/noimage.png";
            })
            .catch(error => {
                this.errorMessage = "データの取得に失敗しました。";
            });
    },
    methods: {
        load(page) {
            axios.get("/api/reserve?page=" + page).then(({ data }) => {
                this.gyms = data.data;
                this.current_page = data.current_page;
                this.last_page = data.last_page;
                this.total = data.total;
                this.from = data.from;
                this.to = data.to;
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
    }
};
</script>

<style scoped>
.navigation {
    margin: 45px 0 0;
}

@media screen and (min-width: 768px) {
    .navigation {
        margin: 72px 0 0;
    }
}
</style>
