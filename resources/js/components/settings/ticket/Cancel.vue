<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
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
                            チケット履歴
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
