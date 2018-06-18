<!--
dev . KANG SANG UN
-->
<template>
  <div id="mySidenav" class="sidenav">
    <!--히든 네비게이션-->
    <div class="hidden-menu-1" v-if="login_type.user_login!=null">
      <button class="closebtn" @click="closeNav()">Ⅹ</button>
      <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+login_type.user_image+'.png'" class="userimg"
      />
      <p>
        {{nav_text.nav_main_text[0]}}
        {{login_type.user_name}}
        {{nav_text.nav_main_text[1]}}
      </p>
      <router-link class="menu" :to="{name:'Mypento'}">{{nav_text.nav_main_text[2]}}</router-link>
      <a @click="hidden_menu()">{{nav_text.nav_main_text[3]}}</a>
      <vs-button vs-type="primary-filled" @click="logout()">{{nav_text.nav_login_text[1]}}</vs-button>
    </div>
    <div class="hidden-menu-1" v-else>
      <button class="closebtn" @click="closeNav()">Ⅹ</button>
      <vs-button vs-type="primary-filled" @click="register_btn(true)">{{nav_text.nav_login_text[0]}}</vs-button>
    </div>
    <div class="hidden-menu-2">
      <span>{{nav_text.nav_menu_text[0]}}</span>
      <router-link class="menu" :to="{name:'main'}">
        {{nav_text.nav_menu_text[1]}}
      </router-link>
      <router-link class="menu" :to="{name:'pentostorylist'}">
        {{nav_text.nav_menu_text[2]}}
      </router-link>
      <router-link class="menu" :to="{name:'pento_col'}">
        {{nav_text.nav_menu_text[3]}}
      </router-link>
      <router-link class="menu" :to="{name:'pentoRank'}">
        {{nav_text.nav_menu_text[4]}}
      </router-link>
    </div>
    <sweet-modal title="Friend Search" ref='frd_modal' overlay-theme="dark" width="50%">
      <div class="add_frd_modal">
        <div class="add_frd_modal_sub1">
          <div class="frd_board">
            <table>
              <thead>
                <tr class="uppercase">
                  <th>{{nav_text.nav_frd_text[0]}}</th>
                  <th> +</th>
                </tr>
              </thead>
              <tbody class="frd-tbody">
                <tr v-for="frdresult in search_result">
                  <td class="frd-table-td-1">
                    {{frdresult.user_nickname}}
                  </td>
                  <td class="frd-table-td-2">
                    <button v-on:click="user_frd_add(frdresult.user_no)">+</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="add_frd_modal_sub2">
          <div class="select_frd">
            <vs-input vs-icon="search" vs-label-placeholder="名前を入力してください。" v-model="frd_name" />
          </div>
          <button class="frd-btn" v-on:click="user_frd_search()">{{nav_text.nav_frd_text[1]}}</button>
          <div class="frd_list">
            <div class="frd_list-title">
              {{nav_text.nav_menu_text[5]}}
            </div>
            <div style="    margin-top: 1vh;">
            <li v-for="frd in frd_list">
              {{frd.user_nickname}}
            </li>
            </div>
          </div>
        </div>
      </div>
    </sweet-modal>
    <sweet-modal ref="register_modal" overlay-theme="dark" width="35%">
      <div class="register-modal-main">
        <div class="register-view" v-if="register_type==true">
          <div class="login-view"></div>
          <div class="login-form">
            <p>{{nav_text.nav_login_text[0]}}</p>
            <vs-input vs-icon="perm_identity" vs-label-placeholder="Id" v-model="userinfo.userid" />
            <vs-input vs-icon="lock" vs-label-placeholder="Password" v-model="userinfo.userpw" />
            <vs-button vs-type="primary-filled" v-on:click="user()">{{nav_text.nav_login_text[0]}}</vs-button>
          </div>
        </div>
        <div class="register-view" v-if="register_type==false">
  
        </div>
      </div>
      <!-- 로그인 성공 모달 -->
    </sweet-modal>
    <sweet-modal icon="success" ref="loginok" class="login_btn">
      {{nav_text.nav_login_text[2]}}<br>
      <vs-button vs-type="primary-filled" v-on:click="login_btn(true)">
      {{nav_text.nav_login_text[4]}}
      </vs-button>
      <!-- 로그인 실패 모달 -->
    </sweet-modal>
    <sweet-modal ref="loginno" icon="error" overlay-theme="dark" modal-theme="dark">
      {{nav_text.nav_login_text[3]}}
      <vs-button vs-type="primary-filled" v-on:click="login_btn(false)">{{nav_text.nav_login_text[4]}}</vs-button>
    </sweet-modal>

  </div>
</template>
<style src="../css/hiddennav.css"></style>
<script>
import lang from "../htmltext/text";
export default {
  /*header req value*/
  created() {
    //로그인 이벤트 감지
    this.$eventBus.$on("login_success", login_type => {
      this.login_register(login_type);
      //결과에 따른 예외 처리
    });
  },
  data() {
    //변수
    return {
      nav_text: lang.navigation, //html 텍스트 값
      userinfo: {
        // 로그인 value 값
        userid: "",
        userpw: ""
      },
      frd_name: [], // 친구 추가 모달 value
      frd_list: [],
      search_result: [], //친구 찾기 결과 값
      register_type: "",
      login_type: {
        //클라이언트 로그인 세션 값
        user_login: sessionStorage.getItem("user_session"),
        user_name: sessionStorage.getItem("user_nickname"),
        user_number: sessionStorage.getItem("user_number"),
        user_image: sessionStorage.getItem("user_image"),
        user_point: sessionStorage.getItem("user_point")
      }
    };
  },
  methods: {
    /*login modal open*/
    register_btn: function(modal_type) {
      this.register_type = modal_type;
      this.$refs.register_modal.open();
    },
    /*friend add modal open*/
    hidden_menu: function() {
      this.$refs.frd_modal.open();
      this.user_frd_list();
    },

    /*hidden bar close*/
    closeNav: function() {
      document.getElementById("mySidenav").style.width = "0";
    },
    /*user login register*/
    user: function() {
      this.$eventBus.$emit("login_function", this.userinfo);
    },
    /*login show result*/
    login_susandfail: function() {
      this.login_type = {
        user_login: sessionStorage.getItem("user_session"),
        user_name: sessionStorage.getItem("user_nickname"),
        user_number: sessionStorage.getItem("user_number"),
        user_image: sessionStorage.getItem("user_image"),
        user_point: sessionStorage.getItem("user_point")
      };
    },
    /*logout function*/
    logout: function() {
      this.userinfo = {
        userid: "",
        userpw: ""
      };
      let url = "logout";
      let art = {
        kinds: "Logout"
      };
      this.axios.post(url, art).then();
      //로그 아웃 후 모든 정보 제거
      sessionStorage.removeItem("user_session");
      sessionStorage.removeItem("user_nickname");
      sessionStorage.removeItem("user_number");
      sessionStorage.removeItem("user_image");
      sessionStorage.removeItem("user_point");
      this.login_type = {
        user_login: null,
        user_name: null,
        user_number: null,
        user_image: null,
        user_point: null
      };
      this.closeNav();
    },
    login_register(condition) {
      if (condition) {
        this.$refs.loginok.open();
        this.login_susandfail();
      } else {
        this.$refs.loginno.open();
      }
    },
    user_frd_list: function() {
      let url = "Friends";
      let art = {
        user_no: sessionStorage.getItem("user_number")
      };
      this.axios.post(url, art).then(response => {
        this.frd_list = response.data;
      });
    },
    /*fried Search function*/
    user_frd_search: function() {
      let url = "SearchValue";
      let art = {
        friends_id: this.frd_name
      };
      this.axios.post(url, art).then(response => {
        this.search_result = response.data;
      });
    },
    user_frd_add: function(frd_name) {
      let url = "AddFriend";
      let art = {
        user_no: sessionStorage.getItem("user_number"),
        friends_no: frd_name
      };
      this.axios.post(url, art).then(response => {
        this.search_result = response.data;
      });
      this.user_frd_list();
    },
    login_btn(condition) {
      if (condition) {
        this.$refs.loginok.close();
        this.$refs.register_modal.close();
      } else {
        this.$refs.loginno.close();
      }
    }
  }
};
</script>
