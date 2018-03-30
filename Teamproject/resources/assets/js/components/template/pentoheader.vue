<template>
    <div class="main_header" id="main">
        <!--친구추가 모달-->
        <div class="header_logo">
        <img id="logo" v-bind:src='"http://localhost:8000/images/main_logo.png"'>
        </div>
         <!--페이지 네비게이션-->
        <div class="header_sub" id="menus">
            <router-link class="menu"  :to="{name:'main'}">Main</router-link>
            <router-link class="menu"  :to="{name:'pentostorylist'}">StoryList</router-link>
            <router-link class="menu"  :to="{name:'col_Main'}">Pento Collection</router-link>
            <router-link class="menu"  :to="{name:'pentoRank'}">Pento Rank</router-link>
            <div class="menu" id="btn5" @click="openNav()">MY page</div>
        </div>
        <div id="mySidenav" class="sidenav"><!--히든 네비게이션-->
            <a href="javascript:void(0)" class="closebtn" @click="closeNav()">&times;</a>
            <div>
                <img v-bind:src='"http://localhost:8000/images/userimg.png"' class="userimg"/>
                <p>김아기님</p>
                <router-link class="menu"  :to="{name:'Mypento'}">내 정보</router-link>
                <a @click="hidden_menu()">친구 추가</a>
            </div> 시;ㅀ은디
             싫은ㄷ ㅣ디디디디 아 에에에에에 씨오 디ㅏ스코
        </div>
        <sweet-modal  ref='frd_modal' overlay-theme="dark" width="50%">
            <div class="add_frd_modal">
                <div class="add_frd_modal_sub1">
                    <div class="frd_board">
                        <li v-for="frd in frd_value">
                            {{frd}}
                        </li>
                    </div>
                </div>
                <div class="add_frd_modal_sub2">
                    <div class="select_frd">
                        <vs-input vs-icon="search"
                                  vs-label-placeholder="친구 이름을 입력해"
                                  v-model="frd_name"/>
                    </div>
                    <button color="red" v-on:click="frd_Search()" >친구추가</button>
                    <div class="frd_list">친구목록들</div>
                </div>
            </div>
        </sweet-modal>
    </div>
</template>
<style src="../css/pentoheader.css"></style>
<script>

    export default {

        data(){
            return {
                frd_value:[],
                frd_name:[],
            }
            },

        methods : {
                    hidden_menu : function () {
                        this.$refs.frd_modal.open();
                    },
                    frd_Search : function () {
                        let user_name = {
                            'user' : this.frd_name
                        };
                        let url = "frd_search";
                        this.axios.post(url,user_name).then(
                            (response)=>
                            this.frd_value=response.data
                        )
                    },
                    openNav:  function () {
                        document.getElementById("mySidenav").
                            style.width = "450px";
                            },

                    closeNav : function () {
                         document.getElementById("mySidenav").
                             style.width = "0";
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