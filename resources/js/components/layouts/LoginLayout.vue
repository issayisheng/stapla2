<template>
    <div>
        <flash-message class="myCustomClass"></flash-message>
        <router-view></router-view>
    </div>
</template>

<script>
export default {};
</script>

<style>
.myCustomClass {
    position: fixed;
    right: 25px;
    top: 50px;
    z-index: 10;
}

.flash__message {
    transition: all 0.5s;
    font-size: 13px;
}
</style>
