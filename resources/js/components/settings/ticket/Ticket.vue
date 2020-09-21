<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">チケット購入</div>
                    <div class="card-body">
                        <div
                            v-if="chargeSuccess"
                            class="alert alert-success py-3 text-center"
                            role="alert"
                        >
                            {{ chargeSuccess }}
                        </div>
                        <div
                            v-if="chargeError"
                            class="alert alert-danger py-3 text-center"
                            role="alert"
                        >
                            {{ chargeError }}
                        </div>

                        <!-- @if(isset( $data ))
                        <p>
                            現在、チケットは<span
                                class="font-weight-bold h1"
                                >{{ $data->quantity }}</span
                            >枚です
                        </p>
                        @else
                        <p>
                            現在、チケットは<span class="font-weight-bold h1"
                                >0</span
                            >枚です
                        </p>
                        @endif -->

                        <!-- <form action="{{ route('charge') }}" method="POST">
                        {{ csrf_field() }}
                        <script
                            src="https://checkout.stripe.com/checkout.js"
                            class="stripe-button"
                            data-key="pk_test_51HFuIFFuVe19htwq8x2UpTNx4IusSvV1DF3F2YU8k76NOzhpUTvaLDqsxtveQdC21EL7Wy32XzNllHKxgt71OUe500C5XMo1rz"
                            data-amount="1500"
                            data-name="Stapla決済"
                            data-label="チケット5枚購入"
                            data-description="チケット5枚分"
                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                            data-locale="auto"
                            data-currency="JPY"
                        ></script>
                        <input type="hidden" value="5" name="order" />
                        </form>  -->

                        <form @submit.prevent="charge">
                            <!-- <script
                                src="https://checkout.stripe.com/checkout.js"
                                class="stripe-button"
                                data-key="pk_test_51HFuIFFuVe19htwq8x2UpTNx4IusSvV1DF3F2YU8k76NOzhpUTvaLDqsxtveQdC21EL7Wy32XzNllHKxgt71OUe500C5XMo1rz"
                                data-amount="3000"
                                data-name="Stapla決済"
                                data-label="チケット10枚購入"
                                data-description="チケット10枚分"
                                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                data-locale="auto"
                                data-currency="JPY"
                            ></script> -->
                            <input type="hidden" value="10" name="order" />
                        </form>
                        <router-link
                            to="/settings/history"
                            class="btn btn-danger"
                        >
                            購入履歴
                        </router-link>
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
            charge: {},
            chargeSuccess: "",
            chargeError: ""
        };
    },
    created() {
        axios
            .get("/api/charge")
            .then(response => {
                // console.log(response.data);
                // this.chargeSuccess = "お支払いが完了しました。";
            })
            .catch(error => {
                console.log("error");
                this.chargeError =
                    "決済に失敗しました。しばらく経ってから再度お試しください。";
            });
    }
};
</script>

<style></style>
