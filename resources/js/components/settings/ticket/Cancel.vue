<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">チケット購入</div>
                    <div class="card-body">
                        <div
                            class="alert alert-danger py-3 text-center"
                            role="alert"
                        >
                            お支払いをキャンセルしました。
                        </div>
                        <router-link
                            to="/settings/ticket"
                            class="btn btn-primary"
                        >
                            チケット購入
                        </router-link>
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
export default {};
</script>

<style></style>
