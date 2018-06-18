<!--
dev . KANG SANG UN
-->
<template>
  <div class="sub_header">
    <div></div>
    <div class="sub_logo">
      <router-link class="sub_btn" :to="{name:'main'}">
        <img v-bind:src='"http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/logo3.png"'>
       
      </router-link>
      <router-link class="sub_btn" :to="{name:'pentostorylist'}">{{header_text[0]}}</router-link>
      <router-link class="sub_btn" :to="{name:'pento_col'}">{{header_text[1]}}</router-link>
      <router-link class="sub_btn" :to="{name:'pentoRank'}">{{header_text[2]}}</router-link>
      <div class="sub_btn" @click="openNav()">{{header_text[3]}}</div>
    </div>
    <div></div>
    <hidnav v-bind:frd_value="frd_values" v-on:frd_search="frd_search"></hidnav>
  </div>
</template>
<style src="../css/new_header.css"></style>
<script>
import hiddne_nav from "../template/hiddnenav.vue";
import lang from "../htmltext/text";
export default {
  data() {
    return {
      header_text: lang.header,
      frd_values: ""
    };
  },
  mounted() {
    this.page_up();
  },
  components: {
    //네비게이션 메뉴 컴포넌트 추가
    hidnav: hiddne_nav
  },
  methods: {
    openNav: function() {
      document.getElementById("mySidenav").style.width = "450px";
    },
    page_up: function() {
      window.scrollTo(0, 0);
    },
    frd_search: function(hid_nav) {
      //search friend
      let url = "frd_search";
      let art = {
        kinds: "Friends",
        method_id: "Search",
        friends_name: hid_nav
      };
      this.axios.post(url).then(response => {
        this.frd_values = response.data;
      });
    }
  }
};
</script>