<template>
    <div>
        <h1>商品一覧</h1>
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Person In Charge</th>
                    <th scope="col">予約</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="calendar in calendars" :key="calendar.id">
                    <th scope="row">{{ calendar.id }}</th>
                    <td>{{ calendar.gym_name }}</td>
                    <td>{{ calendar.dayOfTheWeek }}</td>
                    <td>{{ calendar.time }}</td>
                    <td>{{ calendar.reserved_flag }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            calendars: []
        };
    },
    methods: {
        getCalendars() {
            axios.get("/api/calendar").then(response => {
                this.calendars = response.data;
                console.log(response.data);
            });
        }
    },
    mounted() {
        this.getCalendars();
    }
};
</script>

<style></style>
