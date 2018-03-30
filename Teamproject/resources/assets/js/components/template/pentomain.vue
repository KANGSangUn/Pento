
<template>
    <div class="main-div">
        <headers></headers>
        <div class="main-sub1"> <!--스크롤 이벤트-->
            <input type="radio" name="pos" id="pos1" checked>
            <input type="radio" name="pos" id="pos2">
            <input type="radio" name="pos" id="pos3">
            <input type="radio" name="pos" id="pos4">
            <ul>
                <li>
                    <div>asdasdasdsd</div>
                </li>
                <li>
                    <div>asdaadsasdsdasdsd</div>
                </li>
                <li>
                    <div>a1211sdasdasdsd</div>
                </li>
                <li>
                    <div>
                        <img v-bind:src="'http://localhost:8000/images/main_banner_4.png'"/>
                    </div>
                </li>
            </ul>

            <p class="pos">
                <label for="pos1"></label>
                <label for="pos2"></label>
                <label for="pos3"></label>
                <label for="pos4"></label>
            </p>
        </div> <!--main1 div-->
        <div class="middle-menu">
            <p>PENTO IS SPECIAL</p>
            <div class="info-menu">
                <div class="info-sub">
                    <img v-bind:src='"http://localhost:8000/images/menu1.png"'>
                    <br/>
                    <span>Spatial perception</span>
                    <p>공간을 파고드는 능력</p>
                </div>
                <div class="info-sub">
                    <img v-bind:src='"http://localhost:8000/images/menu2.png"'>
                    <br/>
                    <span>Creativity</span>
                    <p>다양한 해결방법으로 키우는 창의력</p>
                </div>
                <div class="info-sub">
                    <img v-bind:src='"http://localhost:8000/images/menu3.png"'>
                    <br/>
                    <span>Problem-solving</span>
                    <p>문제를 해결 합니다</p>
                </div>
                <div class="info-sub">
                    <img v-bind:src='"http://localhost:8000/images/menu4.png"'>
                    <br/>
                    <span>Concentration</span>
                    <p>그냥 펜토미노가 아니다 펜토다</p>
                </div>
            </div>
        </div>
        <div class="main-menu">
                <div class="menu-2">
                    <div style="background-color:#47b7df">
                        MY PENTO MINO PNETOMI
                    </div>
                    <div class="grid" id="menu-story">
                        <!--스토리 리스트 이동 html-->
                        <figure class="effect-apollo">
                            <img src="../imgs/story.png"/>
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
                            <img src="../imgs/collection.png"/>
                            <router-link :to="{name:'col_Main'}">
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
                            <img src="../imgs/ranking.png"/>
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
    import footers from '../template/Footer.vue';
    import header from '../template/pentoheader.vue';
    export default {
        components : {
            'headers' : header,
            'footers' : footers
        }
    }



</script>

<!--<div class="parallax">-->
    <!--<div class="banner">-->
    <!--</div>-->
<!--</div>-->