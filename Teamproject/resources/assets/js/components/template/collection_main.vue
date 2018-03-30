<template>
    <!-- 나만의 펜토미노, 모두의 펜토미노 이동페이지 -->
    <!-- 나만의 펜토미노, 모두의 펜토미노(최근순 1개) 썸네일 보여줌 -->
    <div class="outer">

        <router-link :to="{name:'col_my'}">
        <div class="innerbox" style="background-color: #FFE400">
            <h1>나만의 펜토미노</h1>
            <!--<img :src="pento_Design" class="imgsize">-->
                <vs-button vs-type="dark-border">더 보기</vs-button>
        </div>
        </router-link>

        <router-link :to="{name:'col_all'}">
        <div class="innerbox" style="background-color: salmon">
            <h1>모두의 펜토미노</h1>
            <img :src="pento_Design" class="imgsize">

        </div>
        </router-link>

    </div>
</template>

<script>
</script>

<style>

    .outer {
        display: inline-block;
        float: left;
        width: 1200px;
        margin: 200px 350px 0 350px;
    }

    .innerbox {
        width: 600px;
        height: 620px;
        margin: 0;
        float: left;
        overflow: hidden;
        display: inline-block;
    }

    .imgsize {
        width: 300px;
        height: 400px;
        margin: 15px 150px 70px 150px;
    }

</style>