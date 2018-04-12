<template>
    <div class="pento-router">
        <!--나만의 펜토미노-->
        <router-link :to="{name:'pento_col_my'}">
        <div class="col-menu">
            <div class="menu-sub">
                <img src="http://localhost:8000/images/web/mypentoimg.png">
                <span>私のペント</span>
            </div>
        </div>
        </router-link>


        <!--모두의 펜토미노-->
        <router-link :to="{name:'main'}">
        <div class="col-menu">
            <div class="menu-sub">
                <img src="http://localhost:8000/images/web/allpentoimg.png">
                <span>皆のペント</span>
            </div>
        </div>
        </router-link>
    </div>
</template>
<style>
    .pento-router{
        margin: 6vw auto;
        width: 75vw;
        height: 70vh;
        display: grid;
        grid-column-gap: 1vw;
        grid-template-columns: 0.5fr 0.5fr;
    }
    .col-menu{
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.5s;
    }
    .col-menu:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
    .menu-sub {
        text-align : center;
        font-size : 2vw;
    }
    .menu-sub span{
        font-family:'Mplus 1p',sans-serif;
    }
    .col-menu:hover {
        color : white;
        background: #2969b9;
    }
</style>