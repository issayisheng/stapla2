<template>
    <div class="container">
        <div class="row justify-content-center">
            <a href="" class="btn btn-primary">プロフィール編集</a>
            <a href="" class="btn btn-secondary">パスワード変更</a>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: []
        };
    },
    created() {
        axios
            .get("/api/user_info")
            .then(response => {
                this.users = response.data;
                console.log(response.data);
            })
            .catch(error => {
                console.log(error);
            });
    }
};
</script>
