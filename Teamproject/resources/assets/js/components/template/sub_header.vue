<template>
    <div class="sub_header">
        <!--친구추가 모달-->
        <div class="sub_logo">
            <img v-bind:src='"http://localhost:8000/images/sub_logo.png"'>
        </div>
        <!--페이지 네비게이션-->
        <div class="sub_menu">
            <router-link class="sub_btn" :to="{name:'main'}">Main</router-link>
            <router-link class="sub_btn" :to="{name:'pentostorylist'}">StoryList</router-link>
            <router-link class="sub_btn" :to="{name:'col_Main'}">Pento Collection</router-link>
            <router-link class="sub_btn" :to="{name:'pentoRank'}">Pento Rank</router-link>
            <div class="sub_btn" @click="openNav()">MY page</div>
        </div>
        <div id="mySidenav" class="sidenav"><!--히든 네비게이션-->
            <a href="javascript:void(0)" class="closebtn" @click="closeNav()">&times;</a>
            <div>
                <img v-bind:src='"http://localhost:8000/images/userimg.png"' class="userimg"/>
                <p>김아기님</p>
                <a href="#">내 정보 페이지 이동하기</a>
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
<style src="../css/sub_header.css"></style>
<script>

    export default {

        data(){
            return {
                frd_value:[],
                frd_name:[],
            }
        },

        methods : {
            hidden_menu: function () {
                this.$refs.frd_modal.open();
            },
            frd_Search: function () {
                let user_name = {
                    'user': this.frd_name
                };
                let url = "frd_search";
                this.axios.post(url, user_name).then(
                    (response) =>
                        this.frd_value = response.data
                )
            },
            openNav: function () {
                document.getElementById("mySidenav").style.width = "450px";
            },

            closeNav: function () {
                document.getElementById("mySidenav").style.width = "0";
            }
        }
    }


</script>