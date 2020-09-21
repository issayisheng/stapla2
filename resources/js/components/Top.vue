<template>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <h1 class="title mb-4">Stapla</h1>
            <p class="mb-5">
                ここに説明文が入ります。<br />ここに説明文が入ります。
            </p>
            <router-link to="/register" class="btn btn-secondary mr-3 btn-lg"
                >新規登録</router-link
            >
            <router-link to="/login" class="btn btn-dark btn-lg"
                >ログイン</router-link
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
    height: 100vh;
    margin: 0;
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
    font-size: 64px;
}
</style>
