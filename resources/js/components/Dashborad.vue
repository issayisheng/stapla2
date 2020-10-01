<template>
    <div class="container py-5">
        <div class="row justify-content-center align-items-start">
            <div class="card-group">
                <router-link to="/gym" class="card">
                    <img
                        class="bd-placeholder-img bd-placeholder-img-lg card-img"
                        width="100%"
                        height="270"
                        src="img/dashboard/reserve.jpg"
                    />
                    <div
                        class="card-img-overlay d-flex justify-content-center align-items-center"
                    >
                        <h2 class="card-title text-white">新規予約</h2>
                    </div>
                </router-link>
                <router-link to="/settings/reserved" class="card">
                    <img
                        class="bd-placeholder-img bd-placeholder-img-lg card-img"
                        width="100%"
                        height="270"
                        src="img/dashboard/confirm.jpg"
                    />
                    <div
                        class="card-img-overlay d-flex justify-content-center align-items-center"
                    >
                        <h2 class="card-title text-white">予約確認</h2>
                    </div>
                </router-link>
                <router-link to="/settings/user_info" class="card">
                    <img
                        class="bd-placeholder-img bd-placeholder-img-lg card-img"
                        width="100%"
                        height="270"
                        src="img/dashboard/mypage.jpg"
                    />
                    <div
                        class="card-img-overlay d-flex justify-content-center align-items-center"
                    >
                        <h2 class="card-title text-white">Mypage</h2>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>
