<!--
dev . KANG SANG UN
-->
<template>
  <div class="mypento_main_div">
    <div class="mypento_div">
      <vs-tabs vs-color="rgb(72, 150, 2)">
        <vs-tab vs-label="私のデータ" @click="debugsss()" class="mypento_sub_div" id="mypento_sub_div1">
          <!--유저 기본 정보 div-->
          <div v-for="user_info in Item_list" class="mypento-info">
            <div>
              <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+user_info.image+'.png'" class="userimg"
              />
            </div>
            <div style="font-size:2.3em">{{user_info.user_nickname}}</div>
            <div style="font-size:1.8em">{{mypage_text[1]}} : {{user_info.user_point}}</div>
            <div class="mypento-intro">        
              {{user_info.user_intro}}
            </div>

          </div>
          <div class="mypento-sub-div-content-2">
            <div style="font-size:2.3em">
              {{mypage_text[3]}}
            </div>
            <div style="font-size:1.5em; padding-top:1.5em;">
                <li v-for="frdlist in frd_list" v-bind:key="frdlist">
              {{frdlist.user_nickname}}
                </li>
            </div>
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
import lang from "../htmltext/text";
export default {
  components: {
    footers: footers
  },
  mounted() {
    //기본 설정
    //페이지 랜더링 후 유저 정보, 친구목록, 동화 구매 정보 메서드실행
    window.scrollTo(0, 0);
    this.load_user_info();
    this.load_user_frd();
    this.load_user_story();
  },
  data() {
    return {
      mypage_text: lang.mypage,
      Item_list: "",
      frd_list: [],
      buy_list: []
    };
  },
  methods: {
    //유저 기본 정보
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