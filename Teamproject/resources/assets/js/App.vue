<template>
    <div class="container">
        <router-view name="header"></router-view>
            <transition name="slide-fade">
                <router-view></router-view>
            </transition>
    </div>
</template>

<script>

</script>
<style>
    .slide-fade-enter-active {
        transition: all .8s ease;
    }
    .slide-fade-leave-active {
        transition: all .8s cubic-bezier(1.0, 1, 1.8, 3.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
    {
        transform: translateX(100px);
        opacity: 0;
    }
</style>
