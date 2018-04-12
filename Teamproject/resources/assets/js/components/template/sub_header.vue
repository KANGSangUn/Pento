<!--
dev . KANG SANG UN
-->
<template>
    <div class="sub_header">
        <!--친구추가 모달-->
        <div class="sub_logo">
            <img v-bind:src='"http://localhost:8000/images/web/sub_logo.png"'>
        </div>
        <!--페이지 네비게이션-->
        <div class="sub_menu">
            <router-link class="sub_btn" :to="{name:'main'}" >Main</router-link>
            <router-link class="sub_btn" :to="{name:'pentostorylist'}">StoryList</router-link>
            <router-link class="sub_btn" :to="{name:'pento_col'}">Pento Collection</router-link>
            <router-link class="sub_btn" :to="{name:'pentoRank'}">Pento Rank</router-link>
            <div class="sub_btn" @click="openNav()">MY page</div>
        </div>
        <hid_nav v-bind:frd_value="frd_values" v-on:frd_search="frd_search"></hid_nav>
    </div>
</template>
<style src="../css/sub_header.css"></style>
<script>
    import hiddne_nav from '../template/hiddnenav.vue';

    export default {
        data(){
          return{
              frd_values : '',
          }
        },
        mounted(){
            this.page_up()
        },
        components : {
            'hid_nav'  : hiddne_nav
        },
        methods : {
            openNav:  function () {
                document.getElementById("mySidenav").
                    style.width = "450px";
            },
            page_up : function () {
                window.scrollTo(0,0);
            },
            frd_search : function (hid_nav) {
                //친구 추가 함수 완성
                let url ="frd_search";
                let art ={
                    'kinds' : 'Friends',
                    'method_id' : 'Search',
                    'friends_name' : hid_nav
                };
                this.axios.post(url).then(
                    (response)=>
                    {
                        this.frd_values = response.data;
                    });


            },


        }
    }

</script>