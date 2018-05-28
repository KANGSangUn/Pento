<!-- 
  dev . Kang sangun
 -->
<template>
  <div class="main-body">
      <!-- first banner -->
      <div class="main-body-1">
          <div></div><div></div>
          <div class="main-body-1-sub">
          <p class="main-body-p-1">{{main_text.main_banner_1_text[0]}}</p>
          <p class="main-body-p-2">{{main_text.main_banner_1_text[1]}}</p>
          <!-- <img src="http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/newweb/main_sub_banner_1.png"> -->
         </div>
      </div>
      <!-- second banner -->
      <div class="main-body-2" id="main-body-2">
          <!-- text event id -->
          <div id="event-1">
              <p id="event-1-1">{{main_text.main_banner_2_text[0]}}</p>
              <span id="event-1-2">{{main_text.main_banner_2_text[1]}}</span>
          </div>
      </div>
      <!-- Third banner  -->
      <div id="main-body-3" class="main-body-banner-1">
          <div class="main-body-3-1">
          </div>
          <div id="evnet-2" class="main-body-3-2">
              <p>{{main_text.main_banner_3_text[0]}}</p>
              <p>{{main_text.main_banner_3_text[1]}}</p>
              <span>{{main_text.main_banner_3_text[2]}}</span><br/>
              <span>{{main_text.main_banner_3_text[3]}}</span><br/>
              <span>{{main_text.main_banner_3_text[4]}}</span>
          </div>
      </div>
      <!-- Fourth banner -->
      <div id="main-body-4" class="main-body-banner-1">
          <div class="main-body-4-1">
              <p>{{main_text.main_banner_4_text[0]}}</p>
              <span>{{main_text.main_banner_4_text[1]}}</span><br/>
              <span>{{main_text.main_banner_4_text[2]}}</span><br/>
              <span>{{main_text.main_banner_4_text[3]}}</span>
  
          </div>
          <div class='main-body-4-2'>
              <iframe width="70%" height="100%" src="https://www.youtube.com/embed/xXAJy4OtcZo" frameborder="0" allow="autoplay; encrypted-media"
                  allowfullscreen>
                      </iframe>
          </div>
      </div>
      <!-- menu banner -->
      <div class="main-body-3">
          <div class="main-body-menu">
              <div class="main-page-menu-sub-banner">
                  <!-- <img class="menu-img" v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/loginimage.png'"/> -->
                  <img class="menu-img" v-bind:src="'http://localhost:8000/images/newimage/menu1.jpg'"/>
                  <div class="menu-title">
                      <!-- banner text -->
                      <p>{{main_text.main_banner_5_text[0]}}</p>
                  </div>
              </div>
          </div>
          <div class="main-body-menu" id="menu-ex">
              <!--Story page render html-->
              <div class="main-page-menu-sub">
                  <router-link :to="{name:'pentostorylist'}">
                      <!-- <img class="menu-img" v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/story.png'"/> -->
                      <img class="menu-img" v-bind:src="'http://localhost:8000/images/newimage/menu2.jpg'"/>
                      <div class="menu-title">
                          <span>{{main_text.main_banner_6_text[0]}}</span>
                          <p>{{main_text.main_banner_6_text[1]}}</p>
                          <div class="menu-index">
                              {{main_text.main_banner_6_text[2]}} <br> 
                              {{main_text.main_banner_6_text[3]}} <br> 
                              {{main_text.main_banner_6_text[4]}}
                          </div>
                      </div>
                  </router-link>
              </div>
          </div>
          <div class="main-body-menu">
              <!-- ranking page render -->
              <div class="main-page-menu-sub">
                  <router-link :to="{name:'pentoRank'}">
                      <!-- <img class="menu-img" src="http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/ranking.png"> -->
                      <img class="menu-img" v-bind:src="'http://localhost:8000/images/newimage/menu3.jpg'"/>
                      <div class="menu-title">
                         <span>{{main_text.main_banner_7_text[0]}}</span>
                          <p>{{main_text.main_banner_7_text[1]}}</p>
                          <div class="menu-index">
                              {{main_text.main_banner_7_text[2]}} <br> 
                              {{main_text.main_banner_7_text[3]}} <br> 
                              {{main_text.main_banner_7_text[4]}}
                          </div>
                      </div>
                  </router-link>
              </div>
          </div>
          <div class="main-body-menu">
              <!-- collection page render -->
              <div class="main-page-menu-sub">
                  <router-link :to="{name:'pento_col'}">
                      <!-- <img class="menu-img" src="http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/collection.png" /> -->
                     <img class="menu-img" v-bind:src="'http://localhost:8000/images/newimage/menu4.jpg'"/>
                     <div class="menu-title">
                         <span>{{main_text.main_banner_8_text[0]}}</span>
                          <p>{{main_text.main_banner_8_text[1]}}</p>
                          <div class="menu-index">
                              {{main_text.main_banner_8_text[2]}} <br> 
                              {{main_text.main_banner_8_text[3]}} <br> 
                              {{main_text.main_banner_8_text[4]}}
                          </div>
                      </div>
                  </router-link>
              </div>
          </div>
      </div>
      <footers></footers>
  </div>
</template>
<script>
import footers from "../template/Footer.vue";
import lang from "../htmltext/text";
export default {
  components: {
    footers: footers
  },
  data() {
    return {
      main_text: lang.main
    };
  },
  created() {
    //page default scroll view
    window.scrollTo(0, 0);
  },
  created: function() {
    window.addEventListener("scroll", this.handleScroll);
  },
  destroyed: function() {
    window.removeEventListener("scroll", this.handleScroll);
  },
  methods: {
    handleScroll: function(event) {
      if (window.scrollY > 450) {
        //css scroll event
        document.getElementById("event-1-1").style.color = "#2a2a2a";
        document.getElementById("event-1-2").style.color = "#2a2a2a";
        document.getElementById("event-1").style.marginTop = "-3%";
      }
      if (window.scrollY > 1200) {
        document.getElementById("evnet-2").style.paddingRight = "30vh";
        document.getElementById("evnet-2").style.color = "#2a2a2a";
      }
    }
  }
};
</script>
<style src='../css/pentomain.css'>
</style>