<!--
dev . KANG SANG UN
-->
<template>
    <div id="mySidenav" class="sidenav"><!--히든 네비게이션-->
        <div class="hidden-menu-1"  v-if="login_type.user_login!='null'">
            <button class="closebtn" @click="closeNav()">Ⅹ</button>
            <img v-bind:src="'http://localhost:8000'+login_type.user_image+'.png'" class="userimg"/>
            <p>{{login_type.user_name}}님 안녕하세요?</p>
            <router-link class="menu"  :to="{name:'Mypento'}">내 정보</router-link>
            <a @click="hidden_menu()">친구 추가</a>
            <vs-button vs-type="primary-filled" @click="logout()">logout</vs-button>

        </div>
        <div class="hidden-menu-1" v-if="login_type.user_login==='null'">
            <button class="closebtn" @click="closeNav()">Ⅹ</button>
            <vs-button vs-type="primary-filled" @click="register_btn(true)">로그인</vs-button>
            <vs-button vs-type="primary-filled" @click="register_btn(false)">회원가입</vs-button>
        </div>
        <div class="hidden-menu-2">
            <span>MENU</span>
            <router-link class="menu"  :to="{name:'main'}">
                Main
            </router-link>
            <router-link class="menu"  :to="{name:'pentostorylist'}">
                StoryList
            </router-link>
            <router-link class="menu"  :to="{name:'col_Main'}">
                Pento Collection
            </router-link>
            <router-link class="menu"  :to="{name:'pentoRank'}">
                Pento Rank
            </router-link>
        </div>
        <sweet-modal  title="Friend Search" ref='frd_modal' overlay-theme="dark" width="50%">
            <div class="add_frd_modal">
                <div class="add_frd_modal_sub1">
                    <div class="frd_board">

                    </div>
                </div>
                <div class="add_frd_modal_sub2">
                    <div class="select_frd">
                        <vs-input vs-icon="search"
                                  vs-label-placeholder="친구 이름을 입력해"
                                  v-model="frd_name"/>
                    </div>
                    <vs-button class="frd-btn" vs-type="success-relief" v-on:click="frd_Search()" >친구추가</vs-button>
                    <div class="frd_list">
                        <li v-for="frd in frd_value">
                            {{frd.user_nickname}}
                        </li>
                    </div>
                </div>
            </div>
        </sweet-modal>
        <sweet-modal ref="register_modal" overlay-theme="dark"  width="35%">
            <div class="register-modal-main">
            <div class="register-view" v-if="register_type==true">
                <div class="login-view"></div>
                <div class="login-form">
                    <p>LOGIN</p>
                    <vs-input vs-icon="perm_identity"
                              vs-label-placeholder="Id"
                              v-model="userinfo.userid"/>
                    <vs-input vs-icon="lock"
                              vs-label-placeholder="Password"
                              v-model="userinfo.userpw"/>
                    <vs-button vs-type="primary-filled" @click="user()">LOGIN</vs-button>
                </div>
            </div>
            <div class="register-view" v-if="register_type==false">

            </div>
            </div>
        </sweet-modal>


        <sweet-modal icon="success" ref="loginok" class="login_btn">
            Login success!
            <vs-button vs-type="primary-filled" @click="login_btn(true)"></vs-button>

        </sweet-modal>
        <sweet-modal ref="loginno"
                     icon="error"  overlay-theme="dark" modal-theme="dark">
            Login Fail!
            <vs-button vs-type="primary-filled" @click="login_btn(false)">로그인 실패!</vs-button>
        </sweet-modal>

    </div>
</template>
<style src="../css/hiddennav.css"></style>
<script>
    export default{
            /*header req value*/
        props: ['frd_value'],
        created(){
            this.$eventBus.$on("login_success",(login_type)=> {
                this.login_register(login_type);
                this.login_susandfail();

            });
            console.log(this.login_type);
        },
        data(){
            return {
                userinfo: {
                    'userid': '',
                    'userpw':''
                },
                frd_name:[],
                register_type :'',
                login_type : {
                    user_login : sessionStorage.getItem('user_session'),
                    user_name : sessionStorage.getItem('user_nickname'),
                    user_number : sessionStorage.getItem('user_number'),
                    user_image : sessionStorage.getItem('user_image'),
                    user_point : sessionStorage.getItem('user_point')
                    }
            }
        },
        methods : {
            /*login modal open*/
            register_btn : function (modal_type) {
                this.register_type = modal_type;
                this.$refs.register_modal.open();
            },
            /*friend add modal open*/
            hidden_menu : function () {
                this.$refs.frd_modal.open();
            },
            /*fried Search function*/
            frd_Search : function () {
                this.$emit("frd_search" , this.frd_name);
            },
            /*hidden bar close*/
            closeNav:  function () {
                document.getElementById("mySidenav").style.width = "0";
            },
            /*user login register*/
            user : function () {
                this.$eventBus.$emit('login_function', this.userinfo);
            },
            /*login show result*/
            login_susandfail : function () {
                this.login_type = {
                        user_login : sessionStorage.getItem('user_session'),
                        user_name : sessionStorage.getItem('user_nickname'),
                        user_number : sessionStorage.getItem('user_number'),
                        user_image : sessionStorage.getItem('user_image'),
                        user_point : sessionStorage.getItem('user_point')
                };


            },
            /*logout function*/
            logout : function () {
                let url = {'kinds':"Logout"};
                this.axios.post(url).then();
                sessionStorage.setItem('user_session','null');
                sessionStorage.removeItem('user_nickname');
                sessionStorage.removeItem('user_number');
                sessionStorage.removeItem('user_image');
                sessionStorage.removeItem('user_point');
                this.login_type= {
                    user_login :'null',
                    user_name : null,
                    user_number : '',
                    user_image : '',
                    user_point : ''
                };
            },
            login_register(condition){
                if(condition){
                    this.$refs.loginok.open();
                }else{
                    this.$refs.loginno.open();
                }
            },
            login_btn(condition){
                if(condition){
                    this.$refs.loginok.close();
                    this.$refs.register_modal.close();
                }else{
                    this.$refs.loginno.close();
                }
            }
        }
    }
</script>

