<template>
    <div>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <h1 class="title mb-4">Stapla</h1>
                <p class="mb-5">
                    ここに説明文が入ります。<br />ここに説明文が入ります。
                </p>
                <router-link :to="{ name: 'login' }" class="btn btn-dark btn-lg"
                    >ログイン</router-link
                >
                <!-- <a
                    class="btn btn-secondary mr-3 btn-lg"
                    href="{{ route('register') }}"
                    role="button"
                    >新規登録</a
                >
                <a
                    class="btn btn-dark btn-lg"
                    href="{{ route('login') }}"
                    role="button"
                    >ログイン</a
                > -->
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style></style>
