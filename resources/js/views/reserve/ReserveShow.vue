<template>
    <div>
        <div
            class="jumbotron d-flex justify-content-center align-items-center"
            :style="{
                backgroundImage: gym.introduction_pic
                    ? 'url(' + '../' + gym.introduction_pic + ')'
                    : 'url(' + noimage + ')'
            }"
        >
            <div class="text-center jumbotron-container">
                <h1 class="site-name text-white">{{ gym.name }}</h1>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 mx-auto py-4">
                        <h5 class="header mb-3">日時を選択</h5>
                        <div class="gym-calender">
                            <div
                                class="calendar-nav d-flex justify-content-between align-items-center"
                            >
                                <a
                                    class="btn btn-outline-primary"
                                    :class="{
                                        disabled: isActiveBtn
                                    }"
                                    :aria-disabled="isActiveBtn ? true : false"
                                    :tabindex="isActiveBtn ? -1 : 0"
                                    role="button"
                                    href="javascript:void(0)"
                                    @click.prevent="prevWeek()"
                                    >前の一週間</a
                                >
                                <div class="month">
                                    <span class="font-weight-bold">{{
                                        calendar_month
                                    }}</span
                                    >月
                                </div>
                                <a
                                    class="btn btn-outline-primary"
                                    href="javascript:void(0)"
                                    @click.prevent="nextWeek()"
                                    >次の一週間</a
                                >
                            </div>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th
                                            v-for="calendar_dayofweek in calendar_dayofweeks"
                                            :key="calendar_dayofweek.id"
                                            :class="[
                                                calendar_dayofweek.is_saturday ===
                                                1
                                                    ? 'saturday'
                                                    : '',
                                                calendar_dayofweek.is_sunday ===
                                                1
                                                    ? 'sunday'
                                                    : ''
                                            ]"
                                            scope="col"
                                        >
                                            {{ calendar_dayofweek.day
                                            }}<span>{{
                                                calendar_dayofweek.day_name_ja
                                            }}</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(value, name) in calendars"
                                        :key="value.id"
                                    >
                                        <td class="time" scope="row">
                                            {{ name }}
                                        </td>
                                        <td
                                            v-for="(item, key) in value"
                                            :key="key.id"
                                            class="position-relative"
                                            :class="[
                                                item.reserved == 0
                                                    ? 'is-open'
                                                    : '',
                                                item.reserved == 1
                                                    ? 'is-close'
                                                    : ''
                                            ]"
                                        >
                                            <template v-if="item.reserved == 0">
                                                <a
                                                    href="javascript:void(0)"
                                                    @click.stop="
                                                        openModal(item)
                                                    "
                                                    class="stretched-link"
                                                    >◯
                                                </a>
                                            </template>
                                            <template v-else>×</template>
                                        </td>
                                    </tr>
                                    <div class="calendar-modal">
                                        <MyModal
                                            @close="closeModal"
                                            v-if="modal"
                                        >
                                            <div class="col-11 mx-auto">
                                                <p class="text-center">
                                                    以下の内容で予約を申し込みます。
                                                </p>
                                                <div
                                                    class="border p-3 border-3 mb-3"
                                                >
                                                    <dl class="row text-left">
                                                        <dt
                                                            class="col-4 col-md-3"
                                                        >
                                                            場所
                                                        </dt>
                                                        <dd
                                                            class="col-8 col-md-9"
                                                        >
                                                            {{ gym.name }}
                                                        </dd>
                                                    </dl>
                                                    <dl class="row text-left">
                                                        <dt
                                                            class="col-4 col-md-3"
                                                        >
                                                            日時
                                                        </dt>
                                                        <dd
                                                            class="col-8 col-md-9"
                                                        >
                                                            {{
                                                                detail.date
                                                                    | moment
                                                            }}({{
                                                                detail.day_name_ja
                                                            }})
                                                            {{ detail.time }}
                                                        </dd>
                                                    </dl>
                                                    <dl class="row text-left">
                                                        <dt
                                                            class="col-4 col-md-3"
                                                        >
                                                            チケット消費
                                                        </dt>
                                                        <dd
                                                            class="col-8 col-md-9"
                                                        >
                                                            1枚
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
                                                                予約管理はお客様の自己管理でお願いします。
                                                            </li>
                                                            <li>
                                                                予約受付は当日、直前でも可能です。
                                                            </li>
                                                            <li>
                                                                キャンセルは前日23:59までとなり、それ以降は予約チケット消化となります。
                                                            </li>
                                                            <li>
                                                                時間変更も前日23:59までが受付期限となります。
                                                            </li>
                                                            <li>
                                                                チケットの残数が0枚の場合は、新たに追加予約をお受けすることが出来ません。
                                                            </li>
                                                            <li>
                                                                予約の仮押さえは禁止しています。<br />キャンセルがあまりに多い場合は、別途チケットを徴収させていただく場合があります。
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="text-center mb-3">
                                                    <a
                                                        href="/privacy"
                                                        target="_blank"
                                                        class="calender-link"
                                                        >「個人情報の取り扱いについて」</a
                                                    >
                                                    <a
                                                        href="/terms"
                                                        target="_blank"
                                                        class="calender-link"
                                                        >「利用規約」</a
                                                    >
                                                    <div>
                                                        同意の上、予約をお願いいたします。
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mx-auto">
                                                    <button
                                                        class="btn btn-outline-primary d-block w-100 mb-3"
                                                        @click.stop="
                                                            submitReserve
                                                        "
                                                    >
                                                        予約する
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MyModal from "../../components/Modal.vue";
import moment from "moment";

export default {
    components: { MyModal },
    data() {
        return {
            modal: false, // モーダル
            isActiveBtn: false,
            id: this.$route.params.id,
            gym: {},
            calendars: [],
            calendar_month: "",
            calendar_dayofweeks: {},
            noimage: "",
            errorMessage: "",
            detail: {},
            displayWeek: moment()
        };
    },
    created() {
        axios
            .get("/api/reserve/" + this.id)
            .then(response => {
                console.log(response.data);
                let obj = {
                    "09:00": [],
                    // "09:30": [],
                    // "10:00": [],
                    "10:30": [],
                    // "11:00": [],
                    // "11:30": [],
                    "12:00": [],
                    // "12:30": [],
                    // "13:00": [],
                    "13:30": [],
                    // "14:00": [],
                    // "14:30": [],
                    "15:00": [],
                    // "15:30": [],
                    // "16:00": [],
                    "16:30": [],
                    // "17:00": [],
                    // "17:30": [],
                    "18:00": [],
                    // "18:30": [],
                    // "19:00": [],
                    "19:30": [],
                    // "20:00": [],
                    // "20:30": [],
                    "21:00": []
                };
                response.data.calendar.forEach(el => {
                    if (el.time == "09:00:00") {
                        obj["09:00"].push(el);
                    } else if (el.time == "09:30:00") {
                        obj["09:30"].push(el);
                    } else if (el.time == "10:00:00") {
                        obj["10:00"].push(el);
                    } else if (el.time == "10:30:00") {
                        obj["10:30"].push(el);
                    } else if (el.time == "11:00:00") {
                        obj["11:00"].push(el);
                    } else if (el.time == "11:30:00") {
                        obj["11:30"].push(el);
                    } else if (el.time == "12:00:00") {
                        obj["12:00"].push(el);
                    } else if (el.time == "12:30:00") {
                        obj["12:30"].push(el);
                    } else if (el.time == "13:00:00") {
                        obj["13:00"].push(el);
                    } else if (el.time == "13:30:00") {
                        obj["13:30"].push(el);
                    } else if (el.time == "14:00:00") {
                        obj["14:00"].push(el);
                    } else if (el.time == "14:30:00") {
                        obj["14:30"].push(el);
                    } else if (el.time == "15:00:00") {
                        obj["15:00"].push(el);
                    } else if (el.time == "15:30:00") {
                        obj["15:30"].push(el);
                    } else if (el.time == "16:00:00") {
                        obj["16:00"].push(el);
                    } else if (el.time == "16:30:00") {
                        obj["16:30"].push(el);
                    } else if (el.time == "17:00:00") {
                        obj["17:00"].push(el);
                    } else if (el.time == "17:30:00") {
                        obj["17:30"].push(el);
                    } else if (el.time == "18:00:00") {
                        obj["18:00"].push(el);
                    } else if (el.time == "18:30:00") {
                        obj["18:30"].push(el);
                    } else if (el.time == "19:00:00") {
                        obj["19:00"].push(el);
                    } else if (el.time == "19:30:00") {
                        obj["19:30"].push(el);
                    } else if (el.time == "20:00:00") {
                        obj["20:00"].push(el);
                    } else if (el.time == "20:30:00") {
                        obj["20:30"].push(el);
                    } else if (el.time == "21:00:00") {
                        obj["21:00"].push(el);
                    }
                });
                this.calendar_month = obj["09:00"][0].month;
                this.calendar_dayofweeks = obj["09:00"];
                this.calendars = obj;
                this.gym = response.data.gym;
                this.noimage = "/img/gym/noimage.png";
            })
            .catch(error => {
                this.errorMessage = "データの取得に失敗しました。";
            });
    },
    methods: {
        openModal(value) {
            this.modal = true;
            const data = {
                plan: value
            };
            let self = this;
            axios
                .post("/api/reserve/confirm", data)
                .then(response => {
                    this.detail = response.data.data.plan;
                })
                .catch(error => {
                    this.modal = true;
                    console.log(error);
                });
        },
        closeModal() {
            this.modal = false;
        },
        submitReserve() {
            var self = this;
            axios
                .post("/api/reserve/post", this.detail)
                .then(response => {
                    if (response.data.ticket == "success") {
                        this.$router.push({
                            name: "reserve_success"
                        });
                    } else if (response.data.ticket == "failed") {
                        this.$router.push({
                            name: "reserve_failed"
                        });
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        nextWeek() {
            this.displayWeek = moment(this.displayWeek).add(1, "w");
            const params = { time: this.displayWeek.format("YYYY-MM-DD") };
            axios
                .get("/api/reserve/next/" + this.id, { params })
                .then(response => {
                    // nullの場合
                    // if (response.data == null) {
                    //     console.log(hogehoge);
                    // これ以上の日程は予約できません
                    // }else{}
                    // 値がある場合
                    console.log(response.data);
                    let obj = {
                        "09:00": [],
                        // "09:30": [],
                        // "10:00": [],
                        "10:30": [],
                        // "11:00": [],
                        // "11:30": [],
                        "12:00": [],
                        // "12:30": [],
                        // "13:00": [],
                        "13:30": [],
                        // "14:00": [],
                        // "14:30": [],
                        "15:00": [],
                        // "15:30": [],
                        // "16:00": [],
                        "16:30": [],
                        // "17:00": [],
                        // "17:30": [],
                        "18:00": [],
                        // "18:30": [],
                        // "19:00": [],
                        "19:30": [],
                        // "20:00": [],
                        // "20:30": [],
                        "21:00": []
                    };
                    response.data.calendar.forEach(el => {
                        if (el.time == "09:00:00") {
                            obj["09:00"].push(el);
                        } else if (el.time == "09:30:00") {
                            obj["09:30"].push(el);
                        } else if (el.time == "10:00:00") {
                            obj["10:00"].push(el);
                        } else if (el.time == "10:30:00") {
                            obj["10:30"].push(el);
                        } else if (el.time == "11:00:00") {
                            obj["11:00"].push(el);
                        } else if (el.time == "11:30:00") {
                            obj["11:30"].push(el);
                        } else if (el.time == "12:00:00") {
                            obj["12:00"].push(el);
                        } else if (el.time == "12:30:00") {
                            obj["12:30"].push(el);
                        } else if (el.time == "13:00:00") {
                            obj["13:00"].push(el);
                        } else if (el.time == "13:30:00") {
                            obj["13:30"].push(el);
                        } else if (el.time == "14:00:00") {
                            obj["14:00"].push(el);
                        } else if (el.time == "14:30:00") {
                            obj["14:30"].push(el);
                        } else if (el.time == "15:00:00") {
                            obj["15:00"].push(el);
                        } else if (el.time == "15:30:00") {
                            obj["15:30"].push(el);
                        } else if (el.time == "16:00:00") {
                            obj["16:00"].push(el);
                        } else if (el.time == "16:30:00") {
                            obj["16:30"].push(el);
                        } else if (el.time == "17:00:00") {
                            obj["17:00"].push(el);
                        } else if (el.time == "17:30:00") {
                            obj["17:30"].push(el);
                        } else if (el.time == "18:00:00") {
                            obj["18:00"].push(el);
                        } else if (el.time == "18:30:00") {
                            obj["18:30"].push(el);
                        } else if (el.time == "19:00:00") {
                            obj["19:00"].push(el);
                        } else if (el.time == "19:30:00") {
                            obj["19:30"].push(el);
                        } else if (el.time == "20:00:00") {
                            obj["20:00"].push(el);
                        } else if (el.time == "20:30:00") {
                            obj["20:30"].push(el);
                        } else if (el.time == "21:00:00") {
                            obj["21:00"].push(el);
                        }
                    });
                    this.calendar_month = response.data.month;
                    this.calendars = obj;
                    this.calendar_dayofweeks = obj["09:00"];
                })
                .catch(error => {
                    console.log(error);
                });
        },
        prevWeek() {
            this.displayWeek = moment(this.displayWeek).subtract(1, "w");
            const params = { time: this.displayWeek.format("YYYY-MM-DD") };
            axios
                .get("/api/reserve/prev/" + this.id, { params })
                .then(response => {
                    let obj = {
                        "09:00": [],
                        // "09:30": [],
                        // "10:00": [],
                        "10:30": [],
                        // "11:00": [],
                        // "11:30": [],
                        "12:00": [],
                        // "12:30": [],
                        // "13:00": [],
                        "13:30": [],
                        // "14:00": [],
                        // "14:30": [],
                        "15:00": [],
                        // "15:30": [],
                        // "16:00": [],
                        "16:30": [],
                        // "17:00": [],
                        // "17:30": [],
                        "18:00": [],
                        // "18:30": [],
                        // "19:00": [],
                        "19:30": [],
                        // "20:00": [],
                        // "20:30": [],
                        "21:00": []
                    };
                    response.data.calendar.forEach(el => {
                        if (el.time == "09:00:00") {
                            obj["09:00"].push(el);
                        } else if (el.time == "09:30:00") {
                            obj["09:30"].push(el);
                        } else if (el.time == "10:00:00") {
                            obj["10:00"].push(el);
                        } else if (el.time == "10:30:00") {
                            obj["10:30"].push(el);
                        } else if (el.time == "11:00:00") {
                            obj["11:00"].push(el);
                        } else if (el.time == "11:30:00") {
                            obj["11:30"].push(el);
                        } else if (el.time == "12:00:00") {
                            obj["12:00"].push(el);
                        } else if (el.time == "12:30:00") {
                            obj["12:30"].push(el);
                        } else if (el.time == "13:00:00") {
                            obj["13:00"].push(el);
                        } else if (el.time == "13:30:00") {
                            obj["13:30"].push(el);
                        } else if (el.time == "14:00:00") {
                            obj["14:00"].push(el);
                        } else if (el.time == "14:30:00") {
                            obj["14:30"].push(el);
                        } else if (el.time == "15:00:00") {
                            obj["15:00"].push(el);
                        } else if (el.time == "15:30:00") {
                            obj["15:30"].push(el);
                        } else if (el.time == "16:00:00") {
                            obj["16:00"].push(el);
                        } else if (el.time == "16:30:00") {
                            obj["16:30"].push(el);
                        } else if (el.time == "17:00:00") {
                            obj["17:00"].push(el);
                        } else if (el.time == "17:30:00") {
                            obj["17:30"].push(el);
                        } else if (el.time == "18:00:00") {
                            obj["18:00"].push(el);
                        } else if (el.time == "18:30:00") {
                            obj["18:30"].push(el);
                        } else if (el.time == "19:00:00") {
                            obj["19:00"].push(el);
                        } else if (el.time == "19:30:00") {
                            obj["19:30"].push(el);
                        } else if (el.time == "20:00:00") {
                            obj["20:00"].push(el);
                        } else if (el.time == "20:30:00") {
                            obj["20:30"].push(el);
                        } else if (el.time == "21:00:00") {
                            obj["21:00"].push(el);
                        }
                    });
                    this.calendars = obj;
                    this.calendar_dayofweeks = obj["09:00"];
                    this.calendar_month = response.data.month;
                    // DBに値がないとき
                    if (response.data.exists == false) {
                        this.isActiveBtn = true;
                    }
                })
                .catch(error => {
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

<style scoped>
.jumbotron {
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    height: 250px;
}

.calendar-nav {
    background: #f2f2f2;
    text-align: center;
    padding: 0.5em 1.5em;
}

.calendar-nav .month span {
    font-size: 18px;
}

.saturday {
    background: #e8f5ff;
    color: #42b0ff;
}

.sunday {
    background: #ffe8ec;
    color: #ff4f6f;
}

.gym-calender thead tr th {
    padding: 0.5em 0;
    font-size: 14px;
    text-align: center;
    line-height: 1.5;
}

.gym-calender thead th span {
    display: block;
    font-size: 12px;
    font-weight: normal;
}

.gym-calender table tbody tr {
    font-weight: 700;
}

.gym-calender table tbody tr:nth-child(even) .time {
    font-weight: normal;
}

.gym-calender table tbody td {
    vertical-align: middle;
    text-align: center;
    height: 51px;
}

.gym-calender table .is-close {
    color: #cecece;
}

.gym-calender table .is-open a {
    color: #ff4f6f;
    font-size: 16px;
}

.gym-calender table .is-open:hover .stretched-link::after {
    background: #fff4f6;
    opacity: 0.76;
    transition: 0.3s;
}

.calender-link {
    color: #00a1e9;
    text-decoration: underline;
}
</style>
