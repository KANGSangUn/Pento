<!--
dev . KANG SANG UN
-->
<template>
    <div class="main_header" id="main">
        <!--친구추가 모달-->
        <div class="header_logo">
        <img id="logo" v-bind:src='"http://localhost:8000/images/web/main_logo.png"'>
            <button @click="openNav()"
                    style="float: right; background:transparent">
                <icon name="bars" color="white" scale="2.5"></icon>
            </button>
        </div>
         <!--페이지 네비게이션-->
        <div class="header_sub" id="menus">
            <router-link class="menu"  :to="{name:'main'}">Main</router-link>
            <router-link class="menu"  :to="{name:'pentostorylist'}">StoryList</router-link>
            <router-link class="menu"  :to="{name:'pento_col'}">Pento Collection</router-link>
            <router-link class="menu"  :to="{name:'pentoRank'}">Pento Rank</router-link>
            <div class="menu" id="btn5" @click="openNav()">MY page</div>
        </div>
        <hid_nav v-bind:frd_value="frd_values" v-on:frd_search="frd_search"></hid_nav>
    </div>
</template>
<style src="../css/pentoheader.css"></style>
<script>
    import hiddne_nav from '../template/hiddnenav.vue';
    export default {
            data(){
                return {
                    frd_values:''
                }
            },
            components : {
               'hid_nav'  : hiddne_nav
            },
            methods : {
                        openNav:  function () {
                            document.getElementById("mySidenav").
                                style.width = "450px";
                        },
                        handleScroll: function (event) {
                            if(window.scrollY>700){
                                document.getElementById("main").style.borderBottom="1px solid #2c2c2c";
                                document.getElementById("main").style.background="white";
                                document.getElementById("logo").style.filter="brightness(20%)";
                                document.getElementById("menus").style.display="grid";
                            }else{
                                document.getElementById("main").style.borderBottom="none";
                                document.getElementById("logo").style.filter="brightness(100%)";
                                document.getElementById("main").style.background="transparent";
                                document.getElementById("menus").style.display="none";

                            }

                        },
                frd_search : function (hid_nav) {
                    //친구 추가 함수 완성
                    let url ="frd_search";
                    let art ={
                        'kinds' : 'Friends',
                        'method_id' : 'Search',
                        'friends_name' : hid_nav
                    }
                    this.axios.post(url,art).then(
                        (response)=>
                        {
                            this.frd_values = response.data;
                        });

                }


                },
            created: function () {
                window.addEventListener('scroll', this.handleScroll);
            },
            destroyed: function () {
                window.removeEventListener('scroll', this.handleScroll);
            }
        }


</script>