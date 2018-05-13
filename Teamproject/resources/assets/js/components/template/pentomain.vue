<!-- 
  dev . Kang sangun
 -->
<template>
  <div class="main-body">
      <!-- first banner -->
      <div class="main-body-1">
          <p class="main-body-p-1">WELCOME</p>
          <p class="main-body-p-2">MY NAME IS PENTO!</p>
          <img src="http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/newweb/main_sub_banner_1.png">
      </div>
      <!-- second banner -->
      <div class="main-body-2" id="main-body-2">
          <!-- text event id -->
          <div id="event-1">
              <p id="event-1-1">
                  PENTO</p>
              <span id="event-1-2">
                      ペントミノをもっと楽しく、面白く</span>
          </div>
      </div>
      <!-- Third banner  -->
      <div id="main-body-3" class="main-body-banner-1">
          <div class="main-body-3-1">
          </div>
          <div id="evnet-2" class="main-body-3-2">
              <p>ペントミノ</p>
              <p>もう詰らない</p>
              <span>それで準備しました</span><br/>
              <span>PENTOのコンテンツ</span><br/>
              <span>ずっと遊びましょう</span>
          </div>
      </div>
      <!-- Fourth banner -->
      <div id="main-body-4" class="main-body-banner-1">
          <div class="main-body-4-1">
              <p>準備できていますか？</p>
              <span>ペントを楽しむために</span><br/>
              <span>必要なのはあなたの</span><br/>
              <span>想像力だけ,何でも作れる</span><br/>
  
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
                  <img class="menu-img" v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/loginimage.png'"
                  />
                  <div class="menu-title">
                      <!-- banner text -->
                      <p>まるで、花のようだ。</p>
                  </div>
              </div>
          </div>
          <div class="main-body-menu" id="menu-ex">
              <!--Story page render html-->
              <div class="main-page-menu-sub">
                  <router-link :to="{name:'pentostorylist'}">
                      <img class="menu-img" v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/story.png'"
                      />
                      <div class="menu-title">
                          <span>Pento Story</span>
                          <p>行こう、物語の中に。</p>
                          <div class="menu-index">
                              ペントですからできる<br/> 皆の想像力を
                              <br/> 会いましょう
                          </div>
                      </div>
                  </router-link>
              </div>
          </div>
          <div class="main-body-menu">
              <!-- ranking page render -->
              <div class="main-page-menu-sub">
                  <router-link :to="{name:'pentoRank'}">
                      <img class="menu-img" src="http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/ranking.png">
                      <div class="menu-title">
                          <span>Pento Rank</span>
                          <p>ランキング、チャート</p>
                          <div class="menu-index">
                              記録からランキング<br/> さらにデータチャートまで
                              <br/> 見てみましょう。
                          </div>
                      </div>
                  </router-link>
              </div>
          </div>
          <div class="main-body-menu">
              <!-- collection page render -->
              <div class="main-page-menu-sub">
                  <router-link :to="{name:'pento_col'}">
                      <img class="menu-img" src="http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/collection.png" />
                      <div class="menu-title">
                          <span>Pento Collections</span>
                          <p>皆のペント</p>
                          <div class="menu-index">
                              ペントでしか会えない<br/> 特別な物語を
                              <br/> 会いましょ
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
export default {
  components: {
    footers: footers
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