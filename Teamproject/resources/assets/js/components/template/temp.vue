<template>
          <div class="rank-body">
            <div id="body-menu" class="grid-format">
                <div>
                </div>
                <div class="border-style" id="play-list-menu">
                  <!--게임 리스트 출력-->
                    <div id="round-list" v-for="gamelist in 6" @click="load_user_play(gamelist)">
                        <!--<div>{{gamelist.design_title}}</div>-->
                        <div id="round-list-images">
                          <!--게임 리스트의 이미지를 띄움.-->
                        <img src="http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/collection/pentoimg1.png">
                        </div>
                        <div>
                          <!--게임 라운드 및 이름 출력 -->
                          돼지
                        </div>
                    </div>
                </div>
            </div>
            <div id="body-main" class="grid-format">
                <div id="grid-format-2">
                  <!--클릭한 게임 값 출력 초기값은 null or res받은 배열의 첫번째 값-->
                    <div class="border-style" id="user-game-title">
                      <span style="vertical-align: middle;">코끼리{{user_play_games.design_title}}</span>
                      </div>
                    <div class="border-style" id="user-game-round">
                      <span style="vertical-align: middle;">
                      5R
                      </span></div>
                </div>
                <div class="border-style" id="rank-img">
                    <!--{{user_play_games}}-->

                        <img src="http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/collection/pentoimg4.png">
                        <p>Ranking 8</p>
                        <p>01:15:54</p>

                </div>
            </div>
            <div id="body-data"> <!--데이터 차트 부분-->
                <div class="border-style">
                    <bar-chart :chart-data="Linedatasets"
                                :width="300"
                                :height="300"></bar-chart>
                </div >
                <div class="border-style">
                    <pie-chart :chart-data="piedatasets"
                                :width="300"
                                :height="300"></pie-chart>
                </div>
                <div class="border-style">
                    <radar-chart :chart-data="Linedatasets"
                                :width="300"
                                :height="300"></radar-chart>
                </div>
                <div class="border-style" id="rank-div">
                        <div>
                            <div v-if="rank_btn===true" v-for="user_rank in frd_rank_record" class="ranking">
                                {{user_rank.rank}}
                                {{user_rank.user_nickname}}
                                {{user_rank.cleartime}}
                            </div>
                            <div v-if="rank_btn===false" v-for="user_rank in user_rank_record" class="ranking">
                                {{user_rank.cleartime}}
                                {{user_rank.register_date}}
                            </div>
                        </div>
                        <div class="btn-div-design">
                            <div class="btn-div-design-1">
                                <button @click="load_frd_play(true)">
                                    친구 랭킹
                                </button>
                            </div>
                            <div class="btn-div-design-2" @click="load_frd_play(false)">
                                <button>
                                    월드 랭킹
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
</template>
<style>
.rank-div {
  width: 100%;
  height: auto;
  font-size: 1vw;
}
.border-style {
  border: 1px solid #8d8d8d;
}
.rank-body {
  width: 100vw;
  height: 100vh;
}
#play-list-menu {
  max-height: 80vh;
  overflow: scroll;
  display: grid;
  grid-template-columns: 0.5fr 0.5fr;
  grid-column-gap: 0.5vh;
  grid-row-gap: 0.5vh;
}
#round-list {
  text-align: center;
  display: grid;
  grid-template-rows: 0.9fr 0.1fr;
  transition: 0.3s;
}
#round-list-images img {
  width: 100%;
  height: 100%;
}

#round-list:hover {
  background-color: orange;
}
#rank-img {
  text-align: center;
}
#rank-img img {
  width: 100%;
  height: 100%;
}
.rank-body {
  display: grid;
  grid-template-columns: 0.2fr 0.4fr 0.4fr;
  grid-column-gap: 1vw;
  margin: auto auto 3vw auto;
  width: 90vw;
  height: 80vh;
}
.grid-format {
  display: grid;
  grid-gap: 0.5vw;
  grid-template-rows: 0.13fr 0.8fr;
}
#grid-format-2 {
  display: grid;
  grid-template-columns: 0.7fr 0.3fr;
  grid-gap: 0.5vw;
}
#body-menu {
}
#body-main {
  text-align: center;
  font-size: 2vw;
}
#user-game-title {
  font-size: 5vh;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}
#user-game-round {
  font-size: 5vh;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
}
#body-data {
  display: grid;
  grid-gap: 0.5vw;
  grid-template-columns: 0.5fr 0.5fr;
  grid-template-rows: 0.5fr 0.5fr;
}
#rank-div {
  display: grid;
  grid-template-rows: 0.8fr 0.2fr;
}
.btn-div-design {
  display: grid;
  grid-template-columns: 0.5fr 0.5fr;
  border-top: 1px solid slategray;
}
.btn-div-design button {
  width: 100%;
  height: 100%;
  font-size: 1vw;
  color: white;
  background: transparent;
}
.btn-div-design-1 {
  background-color: #60a0ff;
}
.btn-div-design-2 {
  background-color: #141c35;
}
.ranking {
  text-align: center;
  border-top: 1px solid silver;
}
</style>
