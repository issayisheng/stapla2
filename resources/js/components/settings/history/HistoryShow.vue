<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">お問い合わせ</div>
                    <div class="card-body">
                        <form action="">
                            本文
                            <textarea
                                name=""
                                id=""
                                cols="30"
                                rows="10"
                                v-model="textarea"
                            ></textarea>
                            <button class="btn btn-danger">投稿する</button>
                        </form>
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
            items: []
        };
    },
    created() {
        axios
            .get("/api/settings/history")
            .then(response => {
                this.items = response.data;
            })
            .catch(error => {
                console.log("error");
            });
    },
    filters: {
        moment: function(date) {
            moment.locale("ja");
            return moment(date).format("lll");
        }
    }
};
</script>
