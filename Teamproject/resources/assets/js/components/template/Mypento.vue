<!--
dev . KANG SANG UN
-->
<template>
  <div class="mypento_main_div">
    <div class="mypento_div">
      <vs-tabs vs-color="rgb(72, 150, 2)">
        <vs-tab vs-label="私のデータ" @click="debugsss()" class="mypento_sub_div" id="mypento_sub_div1">
          <!--유저 기본 정보 div-->
          <div v-for="user_info in Item_list">
            <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+user_info.image+'.png'" class="userimg"
            />
            <h1>こんにちは! {{user_info.user_nickname}}</h1>
            <h2>保有ミノ : {{user_info.user_point}}</h2>
            <h2 style="margin-top : 2vh;">紹介</h2>
            <span style="font-size : 2vh">{{user_info.user_intro}}</span>
          </div>
          <div class="mypento-sub-div-content-2">
            <h1>MY Frined</h1>
            <li v-for="frdlist in frd_list">
              {{frdlist.user_nickname}}
            </li>
          </div>
        </vs-tab>
        <vs-tab vs-label="私の物語" class="mypento_sub_div" id="mypento_sub_div3">
          <div class="my-tale-list">
            <div class="my-tele-list-sub" v-for="buylist in buy_list">
              <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+buylist.tale_image">
            </div>
          </div> 
        </vs-tab>
      </vs-tabs>
    </div><br><br><br>
    <footers></footers>
  </div>
</template>

<style src="../css/mypento.css"></style>
<script>
import footers from "../template/Footer.vue";
export default {
  components: {
    footers: footers
  },
  mounted() {
    window.scrollTo(0, 0);
    this.load_user_info();
    this.load_user_frd();
    this.load_user_story();
  },
  data() {
    return {
      Item_list: "",
      frd_list: [],
      buy_list: []
    };
  },
  methods: {
    load_user_info: function() {
      let url = "MyPage";
      let art = {
        user_no: sessionStorage.getItem("user_number")
      };
      this.axios.post(url, art).then(response => {
        this.Item_list = response.data;
      });
    },
    //serach user friends
    load_user_frd: function() {
      let url = "Friends";
      let art = {
        user_no: sessionStorage.getItem("user_number")
      };
      this.axios.post(url, art).then(response => {
        this.frd_list = response.data;
      });
    },
    //User buylist information
    load_user_story: function() {
      let url = "BuyList";
      let art = {
        user_no: sessionStorage.getItem("user_number")
      };
      this.axios.post(url, art).then(response => {
        this.buy_list = response.data;
      });
    }
  }
};
//
</script>