<template>
    <div class="container">
        <router-view name="header"></router-view>
            <transition name="slide-fade">
                <router-view></router-view>
            </transition>
    </div>
</template>

<script>
export default {
  data() {
    return {
      user_temp: {
        user_nickname: "",
        user_number: "",
        user_image: "",
        user_point: ""
      }
    };
  },
  created() {
    this.$eventBus.$on("login_function", userinfo => {
      //외부객체
      let uri = "userlogin";
      let temp = {
        kinds: "Login",
        user_id: userinfo.userid,
        user_pw: userinfo.userpw
      };
      this.axios.post(uri, temp).then(
        //서버로 http통신 요청
        response => {
          //response 받은 값 이야기 정보 함수에 전송
          this.user_temp.user_nickname = response.data.user_nickname;
          this.user_temp.user_number = response.data.user_no;
          this.user_temp.user_image = response.data.image;
          this.user_temp.user_point = response.data.user_point;
          if (this.user_temp.user_number) {
            this.login_opertion(true);
          } else this.login_opertion(false);
        }
      );
      //if문 처리 후das
    });
  },
  methods: {
    login_opertion: function(login_type) {
      //로그인 결과 출력
      if (login_type) {
        sessionStorage.setItem("user_session", "on");
        sessionStorage.setItem("user_nickname", this.user_temp.user_nickname);
        sessionStorage.setItem("user_number", this.user_temp.user_number);
        sessionStorage.setItem("user_image", this.user_temp.user_image);
        sessionStorage.setItem("user_point", this.user_temp.user_point);
        this.$eventBus.$emit("login_success", true); //로그인결과 전송
      } else {
        sessionStorage.setItem("user_session", null);
        this.$eventBus.$emit("login_success", false);
      }
    }
  }
};
</script>
<style>
.container {
  width: auto;
  height: auto;
}
.slide-fade-enter-active {
  transition: all 0.8s ease;
}
.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 1, 1.8, 3);
}
.slide-fade-enter,
.slide-fade-leave-to {
  transform: translateX(30vw);
  opacity: 0;
}
</style>
