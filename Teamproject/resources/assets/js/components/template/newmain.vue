<template>
    <div class="main-body">
        <div class="main-body-1">
            <p class="main-body-p-1">WELCOME</p>
            <p class="main-body-p-2">MY NAME IS PENTO!</p>
            <img src="http://localhost:8000/images/newweb/main_sub_banner_1.png">
        </div>
        <div class="main-body-2" id="main-body-2">
            <p>PENTO</p>
            <span>ペントミノをもっと楽しく、面白く</span>
        </div>
        <div id="main-body-3">
            <div class="main-body-3-1">
            </div>
            <div class="main-body-3-2">
                <p>ペントミノ</p>
                <p>もう詰らない</p>
                <span>それで準備しました</span><br/>
                <span>PENTOのコンテンツ</span><br/>
                <span>ずっと遊びましょう</span>
            </div>
        </div>
        <div id="main-body-4">
            <div class="main-body-4-1">
                <p>CREATE YOUR PENTO</p>
                <span>必要なのはあなたの</span><br/>
                <span>想像力だけ,何でも作れる</span>
            </div>
            <div class='main-body-4-2'>
                 <iframe width="70%" height="100%"
                            src="https://www.youtube.com/embed/xXAJy4OtcZo"
                            frameborder="0"
                            allow="autoplay; encrypted-media"
                            allowfullscreen>

                    </iframe>
            </div>
        </div>
        <!--<div class="main-body-2" id="main-body-5">-->
            <!--<div class="menu-1">-->
        <!--이 부분은 이쁘나 렉이 너무 심함-->
                <!--<p>Pixel Artで会う</p>-->
                <!--<p>ペントの</p>-->
                <!--<p>特別なコンテンツ</p>-->
            <!--</div>-->
        <!--</div>-->
        <div class="main-body-3">
            <div class="main-body-menu"   id="main-body-3-1"></div>
            <div class="main-body-menu"  id="menu-ex">
                    <!--스토리 리스트 이동 html-->
                    <div class="menu-sub">
                          <router-link :to="{name:'pentostorylist'}">
                          <div class="menu-background-color" id="sub-menu-1"></div>
                         <img  class="menu-img" v-bind:src="'http://localhost:8000/images/web/story.png'"/>
                            <div class="menu-title" >
                              <span>Pento Story List</span>
                              <p>ペントものがたり</p>
                               <div class="menu-index">
                                ペントでしか会えない<br/>
                                特別な物語を<br/>
                                会いましょう
                              
                            </div>
                            </div>
                           
                            </router-link>
                    </div>
            </div>
            <div class="main-body-menu">
                        <!--<img class="rank-image" src="http://localhost:8000/images/web/ranking.png">-->
                        <router-link :to="{name:'pentoRank'}">

                            <!--이 부분 링크달기-->
                        </router-link>
            </div>
            <div class="main-body-menu">
                        <div class="menu-sub">
                            <router-link :to="{name:'pento_col'}">
                                <div class="menu-background-color" id="sub-menu-4"></div>
                                <img class="menu-img" src="http://localhost:8000/images/web/collection.png"/>
                                <div class="menu-title" >
                                <span>Pento Collections</span>
                                <p>ペントコレクション</p>
                                <div class="menu-index">
                                    ペントでしか会えない<br/>
                                    特別な物語を<br/>
                                    会いましょ
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
  /*
         * components
         * header footer import
         */
  components: {
    footers: footers
  }
};
</script>
<style src='../css/newmain.css'>