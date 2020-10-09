<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
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
                                    class="bd-placeholder-img card-img-top"
                                    :src="'/img/gym/gym.png'"
                                    alt="The cover of Stubborn Attachments"
                                />
                                <div class="card-body">
                                    <h5 class="card-title">チケット10枚分</h5>
                                    <p>¥33,000(税込)</p>
                                    <button
                                        @click.prevent="checkout('BASIC')"
                                        class="checkout-button"
                                        id="basic-plan-btn"
                                    >
                                        Checkout
                                    </button>
                                </div>
                            </div>
                            <div class="card">
                                <img
                                    class="bd-placeholder-img card-img-top"
                                    :src="'/img/gym/gym2.png'"
                                    alt="The cover of Stubborn Attachments"
                                />
                                <div class="card-body">
                                    <h5 class="card-title">チケット20枚分</h5>
                                    <p>¥61,600(税込)</p>
                                    <button
                                        @click.prevent="checkout('PLUS')"
                                        class="checkout-button"
                                        id="plus-plan-btn"
                                    >
                                        Checkout
                                    </button>
                                </div>
                            </div>
                            <div class="card">
                                <img
                                    class="bd-placeholder-img card-img-top"
                                    :src="'/img/gym/gym3.png'"
                                    alt="The cover of Stubborn Attachments"
                                />
                                <div class="card-body">
                                    <h5 class="card-title">チケット30枚分</h5>
                                    <p>¥82,500(税込)</p>
                                    <button
                                        @click.prevent="checkout('PRO')"
                                        class="checkout-button"
                                        id="pro-plan-btn"
                                    >
                                        Checkout
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
                plan: type
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
                console.log(response);
            })
            .catch(error => {
                console.log(error);
            });
    }
};
</script>

<style scoped>
.checkout-button {
    background: #92e3a9;
    color: #fff;
    font-size: 14px;
    border: 0;
    padding: 10px 16px;
    font-weight: 500;
    cursor: pointer;
    border-radius: 6px;
    transition: opacity 0.2s ease;
    display: block;
    width: 100%;
}
.checkout-button:hover {
    opacity: 0.8;
}
</style>
