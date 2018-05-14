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
      <p>こんにちは！{{login_type.user_name}}さん</p>
      <router-link class="menu" :to="{name:'Mypento'}">MY PENTO</router-link>
      <a @click="hidden_menu()">友達探し</a>
      <vs-button vs-type="primary-filled" @click="logout()">logout</vs-button>
    </div>
    <div class="hidden-menu-1" v-else>
      <button class="closebtn" @click="closeNav()">Ⅹ</button>
      <vs-button vs-type="primary-filled" @click="register_btn(true)">Login</vs-button>
    </div>
    <div class="hidden-menu-2">
      <span>MENU</span>
      <router-link class="menu" :to="{name:'main'}">
        Main
      </router-link>
      <router-link class="menu" :to="{name:'pentostorylist'}">
        StoryList
      </router-link>
      <router-link class="menu" :to="{name:'pento_col'}">
        Pento Collection
      </router-link>
      <router-link class="menu" :to="{name:'pentoRank'}">
        Pento Rank
      </router-link>
    </div>
    <sweet-modal title="Friend Search" ref='frd_modal' overlay-theme="dark" width="50%">
      <div class="add_frd_modal">
        <div class="add_frd_modal_sub1">
          <div class="frd_board">
            <table>
              <thead>
                <tr class="uppercase">
                  <th>検索結果</th>
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
          <button class="frd-btn" v-on:click="user_frd_search()">サーチ</button>
          <div class="frd_list">
            <li v-for="frd in frd_list">
              {{frd.user_nickname}}
            </li>
          </div>
        </div>
      </div>
    </sweet-modal>
    <sweet-modal ref="register_modal" overlay-theme="dark" width="35%">
      <div class="register-modal-main">
        <div class="register-view" v-if="register_type==true">
          <div class="login-view"></div>
          <div class="login-form">
            <p>LOGIN</p>
            <vs-input vs-icon="perm_identity" vs-label-placeholder="Id" v-model="userinfo.userid" />
            <vs-input vs-icon="lock" vs-label-placeholder="Password" v-model="userinfo.userpw" />
            <vs-button vs-type="primary-filled" v-on:click="user()">LOGIN</vs-button>
          </div>
        </div>
        <div class="register-view" v-if="register_type==false">
  
        </div>
      </div>
      <!-- 로그인 성공 모달 -->
    </sweet-modal>
    <sweet-modal icon="success" ref="loginok" class="login_btn">
      Login success!
      <vs-button vs-type="primary-filled" v-on:click="login_btn(true)"></vs-button>
      <!-- 로그인 실패 모달 -->
    </sweet-modal>
    <sweet-modal ref="loginno" icon="error" overlay-theme="dark" modal-theme="dark">
      Login Fail!
      <vs-button vs-type="primary-filled" v-on:click="login_btn(false)">로그인 실패!</vs-button>
    </sweet-modal>

  </div>
</template>
<style src="../css/hiddennav.css"></style>
<script>
export default {
  /*header req value*/
  created() {
    this.$eventBus.$on("login_success", login_type => {
      this.login_register(login_type);
    });
  },
  data() {
    return {
      userinfo: {
        userid: "",
        userpw: ""
      },
      frd_name: [],
      frd_list: [],
      search_result: [],
      register_type: "",
      login_type: {
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
      //                <input type="submit" value="로그아웃"> O O
      //                <input type="hidden" value="Logout" name="kinds">
      this.axios.post(url, art).then();
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
