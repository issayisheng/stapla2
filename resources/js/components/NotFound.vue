<template>
    <div class="flex-center full-height">
        <div class="content">
            <h1 class="title">404 Not Found</h1>
            <p class="error-message">お探しのページは存在しません。</p>
            <div class="error-detail mb-5">
                もしくは一時的にアクセスできないか、移動または削除された可能性があります。<br />URLに間違いがないかご確認をお願いいたします。
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
