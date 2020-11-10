<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card ticket-card">
                    <div
                        class="card-header d-md-flex align-items-center justify-content-between"
                    >
                        <div>チケット購入</div>
                        <div>
                            <span v-if="user.length == 0">
                                現在、チケットは
                                <span class="font-weight-bold text-danger"
                                    >0</span
                                >枚です
                            </span>
                            <span v-else>
                                現在、チケットは
                                <span class="font-weight-bold text-danger">{{
                                    user.quantity
                                }}</span
                                >枚です
                            </span>
                            <router-link
                                to="/settings/history"
                                class="btn btn-outline-danger ml-3"
                            >
                                チケット履歴
                            </router-link>
                        </div>
                    </div>
                    <div class="card-body">
                        <div
                            v-if="chargeError"
                            class="alert alert-danger py-3 text-center"
                            role="alert"
                        >
                            {{ chargeError }}
                        </div>
                        <div class="card-group mb-3">
                            <div class="card">
                                <img
                                    class="bd-placeholder-img card-img-top ticket-img"
                                    :src="'/img/ticket/ticket1.png'"
                                    alt="The cover of Stubborn Attachments"
                                />
                                <div class="card-body">
                                    <div
                                        class="license-cta_text__name text-center"
                                    >
                                        Basic
                                    </div>
                                    <div class="ticket-price text-center">
                                        <span class="ticket-price__icon"
                                            >¥</span
                                        >
                                        <span class="ticket-price__num"
                                            >33,000</span
                                        >
                                    </div>
                                    <div class="ticket-desc">
                                        <img
                                            :src="'/img/ticket/check-icon.svg'"
                                            alt="check"
                                            class="check-icon"
                                        />
                                        チケット10枚分
                                    </div>
                                    <div class="ticket-desc">
                                        <img
                                            :src="'/img/ticket/check-icon.svg'"
                                            alt="check"
                                            class="check-icon"
                                        />
                                        1枚あたり¥3,300
                                    </div>
                                    <div class="ticket-desc">
                                        <img
                                            :src="'/img/ticket/check-icon.svg'"
                                            alt="check"
                                            class="check-icon"
                                        />
                                        まずはお試しの10枚セット
                                    </div>
                                    <button
                                        @click.prevent="checkout('BASIC')"
                                        class="checkout-button"
                                        id="basic-plan-btn"
                                    >
                                        購入する
                                    </button>
                                </div>
                            </div>
                            <div class="card">
                                <img
                                    class="bd-placeholder-img card-img-top ticket-img"
                                    :src="'/img/ticket/ticket2.png'"
                                    alt="The cover of Stubborn Attachments"
                                />
                                <div class="card-body">
                                    <div
                                        class="license-cta_text__name text-center"
                                    >
                                        Plus
                                    </div>
                                    <div class="ticket-price text-center">
                                        <span class="ticket-price__icon"
                                            >¥</span
                                        >
                                        <span class="ticket-price__num"
                                            >61,600</span
                                        >
                                    </div>
                                    <div class="ticket-desc">
                                        <img
                                            :src="'/img/ticket/check-icon.svg'"
                                            alt="check"
                                            class="check-icon"
                                        />
                                        チケット20枚分
                                    </div>
                                    <div class="ticket-desc">
                                        <img
                                            :src="'/img/ticket/check-icon.svg'"
                                            alt="check"
                                            class="check-icon"
                                        />
                                        1枚あたり¥3,080
                                    </div>
                                    <div class="ticket-desc">
                                        <img
                                            :src="'/img/ticket/check-icon.svg'"
                                            alt="check"
                                            class="check-icon"
                                        />
                                        おすすめなプラン
                                    </div>
                                    <button
                                        @click.prevent="checkout('PLUS')"
                                        class="checkout-button"
                                        id="plus-plan-btn"
                                    >
                                        購入する
                                    </button>
                                </div>
                            </div>
                            <div class="card">
                                <img
                                    class="bd-placeholder-img card-img-top ticket-img"
                                    :src="'/img/ticket/ticket3.png'"
                                    alt="The cover of Stubborn Attachments"
                                />
                                <div class="card-body">
                                    <div
                                        class="license-cta_text__name text-center"
                                    >
                                        Pro
                                    </div>
                                    <div class="ticket-price text-center">
                                        <span class="ticket-price__icon"
                                            >¥</span
                                        >
                                        <span class="ticket-price__num"
                                            >82,500</span
                                        >
                                    </div>
                                    <div class="ticket-desc">
                                        <img
                                            :src="'/img/ticket/check-icon.svg'"
                                            alt="check"
                                            class="check-icon"
                                        />
                                        チケット30枚分
                                    </div>
                                    <div class="ticket-desc">
                                        <img
                                            :src="'/img/ticket/check-icon.svg'"
                                            alt="check"
                                            class="check-icon"
                                        />
                                        1枚あたり¥2,750
                                    </div>
                                    <div class="ticket-desc">
                                        <img
                                            :src="'/img/ticket/check-icon.svg'"
                                            alt="check"
                                            class="check-icon"
                                        />
                                        繰り返し使う人にオススメ
                                    </div>
                                    <button
                                        @click.prevent="checkout('PRO')"
                                        class="checkout-button"
                                        id="pro-plan-btn"
                                    >
                                        購入する
                                    </button>
                                </div>
                            </div>
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
            user: {},
            plan: "",
            chargeError: "",
            stripe: Stripe(
                "pk_test_51HFuIFFuVe19htwq8x2UpTNx4IusSvV1DF3F2YU8k76NOzhpUTvaLDqsxtveQdC21EL7Wy32XzNllHKxgt71OUe500C5XMo1rz"
            )
        };
    },
    methods: {
        checkout: function(type) {
            const data = {
                plan: type,
                img: type
            };
            axios
                .post("/api/checkout", data)
                .then(response => {
                    return response.data;
                })
                .then(session => {
                    return this.stripe.redirectToCheckout({
                        sessionId: session.id
                    });
                })
                .then(result => {
                    if (result.error) {
                        alert(result.error.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    this.chargeError =
                        "通信に失敗しました。しばらく経ってから再度お試しください。";
                });
        }
    },
    created() {
        axios
            .get("/api/settings/ticket")
            .then(response => {
                this.user = response.data;
            })
            .catch(error => {
                console.log(error);
            });
    }
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@400;500;700&display=swap");

.license-cta_text__name {
    font-size: 20px;
    font-weight: 500;
    font-family: "Red Hat Display", sans-serif;
}

.ticket-price {
    font-weight: 700;
    font-family: "Red Hat Display", sans-serif;
    margin: 0 0 10px;
}

.ticket-price__icon {
    font-size: 24px;
}

.ticket-price__num {
    margin: 0 0 12px;
    font-size: 40px;
}

.ticket-desc {
    margin: 0 0 12px;
}

.check-icon {
    width: 14px;
    margin: 0 3px 0 0;
}

.checkout-button {
    border: 1px solid #0acf83;
    background: #fff;
    color: #0acf83;
    font-size: 14px;
    padding: 10px 16px;
    font-weight: 500;
    cursor: pointer;
    border-radius: 6px;
    transition: all 0.2s ease;
    display: block;
    width: 100%;
}

.checkout-button:hover,
.checkout-button:focus {
    background: #0acf83;
    color: #fff;
    outline: none;
}

.ticket-img {
    width: 70%;
    margin: 0 auto;
}
</style>
