<template>
    <div class="flex-center full-height">
        <div class="content">
            <h1 class="title">アカウントの登録を受け付けました。</h1>
            <div class="mb-5">
                ご登録いただいたメールアドレス宛てに登録確認用のご案内をお送りしました。<br />
                Staplaアカウントの登録確認を完了してください。<br />
            </div>
            <router-link class="btn btn-primary" :to="{ name: 'top' }"
                >ホームへ戻る</router-link
            >
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style scoped>
html,
body {
    background-color: #fff;
    color: #636b6f;
    height: 100vh;
    margin: 0;
    font-size: 16px;
}

.full-height {
    height: 100vh;
}

.flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
}

.content {
    text-align: center;
}

.title {
    font-size: 36px;
    padding: 20px;
}
</style>
