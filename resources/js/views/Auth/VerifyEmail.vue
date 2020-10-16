<template>
    <div>
        <app-header></app-header>
        <div class="container">
            <div class="verify-email">
                <h1 class="verify-email__title">
                    アカウントの登録を受け付けました。
                </h1>
                <div class="verify-email__text col-md-6 mx-auto">
                    ご登録いただいたメールアドレス宛てに登録確認用のご案内をお送りしました。<br />
                    Staplaアカウントの登録確認を完了してください。<br />
                </div>
                <router-link class="btn btn-primary" :to="{ name: 'login' }"
                    >ログイン画面へ</router-link
                >
            </div>
        </div>
        <app-footer></app-footer>
    </div>
</template>

<style scoped>
.verify-email {
    padding: 60px 0;
    text-align: center;
}

.verify-email__title {
    font-size: 24px;
    margin: 0 0 24px;
    line-height: 1.35;
}

.verify-email__text {
    margin: 0 0 30px;
    text-align: justify;
}

@media screen and (min-width: 768px) {
    .verify-email__title {
        font-size: 32px;
        margin: 0 0 40px;
    }
}
</style>
