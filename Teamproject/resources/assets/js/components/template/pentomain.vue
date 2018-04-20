<!--
dev . KANG SANG UN
main div
[
    main sub1
    midden menu1
    midden menu2
    page menu
]

-->
<template>
    <div class="main-div">
        <headers></headers>

        <div class="main-sub1">
            <!--main banner move selcet button-->
            <input type="radio" name="pos" id="pos1" checked>
            <input type="radio" name="pos" id="pos2">
            <input type="radio" name="pos" id="pos3">
            <input type="radio" name="pos" id="pos4">
            <ul>
                <!--main banner background-->
                <!--li x 4  = four background banner-->
                <li class="banner-li">
                    <div class="parallax"></div>
                    <div class="menu-1">
                        <p>ようこそ</p>
                        <p>ペントの</p>
                        <p>世界に</p>
                    </div>
                </li>
                <li class="banner-li">
                    <div class="menu-2-2">
                    </div>
                    <div class="menu-1">
                        <p>PENTOMINO + IT</p>
                        <p>新しい</p>
                        <p>オモチャ</p>
                    </div>
                </li>
                <li class="banner-li-2">
                    <div class="menu-3 ">
                        <div class="menu-1">
                            <p>Pixel Artで会う</p>
                            <p>ペントの</p>
                            <p>特別なコンテンツ</p>
                        </div>
                    </div>
                </li>
                <li class="banner-li">
                    <div class="menu-4-1">
                        <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/main_banner_4.png'"/>
                    </div>
                    <div class="menu-4-2">
                        <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/main_banner_4_1.png'"/>
                        <button>
                            <scrollactive class="my-nav"
                                          active-class="active"
                                          :offset="80"
                                          :duration="1000"
                                          bezier-easing-value=".5,0,.35,1">
                                <a href="#middle-menu" class="scrollactive-item">Home</a>
                            </scrollactive>
                        </button>
                        <div class="menu-4" style="position: absolute">
                            <p>宇宙みたいに</p>
                            <p>広い</p>
                            <p>ペントの</p>
                            <p>CONTENTS</p>
                        </div>
                    </div>
                </li>
            </ul>
            <p class="pos">
                <label for="pos1"></label>
                <label for="pos2"></label>
                <label for="pos3"></label>
                <label for="pos4"></label>
            </p>
        </div>   <!--middle menu-->
        <div id="middle-menu" class="middle-menu">
            <p>PENTO IS SPECIAL</p>
            <div class="info-menu">
                <div class="info-sub">
                    <img v-bind:src='"http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/menu1.png"'>
                    <br/>
                    <span>Spatial perception</span>
                    <p>頭いいな</p>
                </div>
                <div class="info-sub">
                    <img v-bind:src='"http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/menu2.png"'>
                    <br/>
                    <span>Creativity</span>
                    <p>다양한 해결방법으로 키우는 창의력</p>
                </div>
                <div class="info-sub">
                    <img v-bind:src='"http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/menu3.png"'>
                    <br/>
                    <span>Problem-solving</span>
                    <p>문제를 해결 합니다</p>
                </div>
                <div class="info-sub">
                    <img v-bind:src='"http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/menu4.png"'>
                    <br/>
                    <span>Concentration</span>
                    <p>그냥 펜토미노가 아니다 펜토다</p>
                </div>
            </div>
        </div>
        <div id="middle-menu-2" class="middle-menu-2">
            <div class="parallax2">

                <div class="middle-menu-2-sub-1">
                    <p>PLAY PENTO VIDEO</p>
                    <scrollactive class="my-nav"
                                  active-class="active"
                                  :offset="80"
                                  :duration="1000"
                                  bezier-easing-value=".5,0,.35,1">
                        <a href="#main-menu" class="scrollactive-item">Home</a>
                    </scrollactive>
                    <div style="width: 40vw">

                    <span>
                        Slip inside the eye of your mind
                        Don't you know you might find
                        A better place to play
                        You said that you'd never been
                        But all the things that you've seen
                        Will slowly fade awayasdasd
                    </span>
                    </div>
                </div>
                <div class="middle-menu-2-sub-2">
                    <iframe width="70%" height="100%"
                            src="https://www.youtube.com/embed/xXAJy4OtcZo"
                            frameborder="0"
                            allow="autoplay; encrypted-media"
                            allowfullscreen>

                    </iframe>
                </div>
            </div>
        </div>
        <div class="main-menu" id="main-menu">
                <div class="menu-2">
                    <div style="background-color:#47b7df">
                    </div>
                    <div class="grid" id="menu-story">
                        <!--스토리 리스트 이동 html-->
                        <figure class="effect-apollo">
                            <img v-bind:src="'http://localhost:8000/images/web/story.png'"/>
                            <router-link :to="{name:'pentostorylist'}">
                                <figcaption>
                                    <h2>PENTO STORY</h2>
                                    <p>오직 펜토에서만 만날 수 있는 특별한 동화</p>
                                    <!--이 부분 링크달기-->
                                </figcaption>
                            </router-link>
                        </figure>
                    </div>
                    <div style="background-color:#df6b67"></div>
                </div>
                <div class="menu-2">
                    <div class="grid" id="menu-col" >
                        <!--펜토미노 컬렉션-->
                        <figure class="effect-apollo">
                            <img src="http://localhost:8000/images/web/collection.png"/>
                            <router-link :to="{name:'pento_col'}">
                                <figcaption>
                                    <h2>Pento collection</h2>
                                    <p>모두의 펜토미노</p>
                                    <!--이 부분 링크달기-->
                                </figcaption>
                            </router-link>
                        </figure>
                    </div>
                    <div style="background-color:#67df6e"></div>
                    <div class="grid" id="menu-rank">
                        <!--펜토미노 랭크-->
                        <figure class="effect-apollo">
                            <img src="http://localhost:8000/images/web/ranking.png"/>
                            <router-link :to="{name:'pentoRank'}">
                                <figcaption>
                                    <h2>Pento Rank</h2>
                                    <p>당신의 기록을 친구와 비교해봅시다</p>
                                    <!--이 부분 링크달기-->
                                </figcaption>
                            </router-link>
                        </figure>
                    </div>
                </div>
        </div>
        <footers></footers>
    </div>
</template>

<style src="../css/pentomain.css">
</style>
<script>

    import header from '../template/pentoheader.vue';
    import footers from '../template/Footer.vue';
    export default {
        /*
         * components
         * header footer import
        */
        components : {
            'headers' : header,
            'footers' : footers
        },


    }



</script>

