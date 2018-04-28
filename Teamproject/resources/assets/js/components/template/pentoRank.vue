<!--
dev . KANG SANG UN
-->
<template>
    <div class="rank-page-div">
        <div class="rank-page-div-body">
              <div class="rank-page-div-1">
                 <div class="rank-page-div-1-sub"></div>
                  <div class="rank-page-div-1-sub"></div>
                   <div class="rank-page-div-1-sub"></div>
                  <div class="rank-page-div-1-sub"></div>
                  <div class="rank-page-div-1-sub"></div>
                  <div class="rank-page-div-1-sub"></div>
                  <div class="rank-page-div-1-sub"></div>
                  <div class="rank-page-div-1-sub"></div>
                  <div class="rank-page-div-1-sub"></div>
              </div>
              <div class="rank-page-div-2">
                <div class="rank-page-div-2-sub-1"></div>
                <div class="rank-page-div-2-sub-2">
                  
                </div>
              </div>
              <div class="rank-page-div-3">
                <div class="rank-page-div-3-sub-1">
                  <bar-chart :chart-data="Linedatasets"
                  :width="250"
                  :height="150"></bar-chart> 
                </div>
                <div class="rank-page-div-3-sub-2">
                  <div>
                    <pie-chart :chart-data="piedatasets"></pie-chart>
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
          </div>
        <footers></footers> <!--footer area-->
    </div>

</template>
<style src="../css/pentoRank.css"></style>

<script>
import RadarChart from "../js/Radar.js";
import PieChart from "../js/Pie.js";
import BarChart from "../js/Bar.js";

import footers from "../template/Footer.vue";
export default {
  components: {
    footers: footers,
    RadarChart: RadarChart,
    PieChart: PieChart,
    BarChart: BarChart
  },
  mounted() {
    this.load_frd_play();
    //this.search_my_play(); //페이지 실행시 모든 게임 기록 값 출력
  },
  data() {
    return {
      linedatasets: null,
      piedatasets: null,
      radardatasets: null,
      search_rank: [],
      search_frd: "",
      game_record: {},
      user_play_games: [],
      frd_rank_record: [],
      user_rank_record: [],
      rank_btn: null,
      frdname: ["pakg", "asdkw", "asdkwk1", "goodgoo", "asdw"],
      frdrecoed: [
        this.getRandomInt(),
        this.getRandomInt(),
        this.getRandomInt(),
        this.getRandomInt(),
        this.getRandomInt()
      ],
      datacolor: [
        "#6ef864",
        "#ffba63",
        "#3079f8",
        "#f86077",
        "#38a21e",
        "#d44ac2"
      ]
    };
  },

  methods: {
    //랭크 페이지의 함수 정의
    search_my_play: function() {
      let url = "Rank_list"; //기록 메뉴
      let art = {
        kinds: "Page",
        page_name: "Rank"
      };
      this.axios.post(url, art).then(response => {
        this.game_record = response.data;
      });
    },
    load_user_play: function(select_game) {
      let url = "select_game_rank"; //나의 현재 기록
      let art = {
        kinds: "Page",
        category: "Rank",
        detailed_value: select_game.design_no
      };
      this.user_play_games = select_game;
      this.axios.post(url, art).then(response => {
        this.frd_rank_record = response.data.userRank;
        this.user_rank_record = response.data.userRecord;
      });

      this.load_frd_play(true, this.frd_rank_record);
    },
    load_frd_play: function() //                temp,frd_record
    {
      //                this.frdname=[];
      //                this.frdrecoed=[];
      //                for(let i=0; i<frd_record.length;i++){
      //                    this.frdname.push(frd_record[i].user_nickname);
      //                    this.frdrecoed.push(this.getRandomInt());
      //                }
      //                this.rank_btn = temp;
      this.piedatasets = {
        labels: this.frdname,
        datasets: [
          {
            backgroundColor: this.datacolor,
            data: this.frdrecoed
          }
        ]
      };
      this.Linedatasets = {
        labels: this.frdname,
        datasets: [
          {
            backgroundColor: this.datacolor,
            data: this.frdrecoed
          }
        ]
      };
      this.radardatasets = {
        labels: this.frdname,
        datasets: [
          {
            backgroundColor: "#f8b213",
            data: this.frdrecoed
          }
        ]
      };
    },
    getRandomInt() {
      return Math.floor(Math.random() * (50 - 5 + 1)) + 5;
    }
  }
};
</script>
<sc