<!--
dev . KANG SANG UN
-->
<template>
  <div class="rank-page-div">
    <div class="rank-page-div-body">
    
      <div class="rank-page-div-1">  
        <div class="rank-page-title">
          RANKS
        </div>
        <div class="rank-page-list">
          <div class="rank-page-div-1-sub" v-for="game_list in game_record" @click="load_user_play(game_list.design_no,game_list.imitated_image)">
            <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+ game_list.imitated_image">
          </div>
        </div>
      </div>
      <div class="rank-page-div-2">
          <div class="spinner" id="loadding">
          </div>
          <div class="rank-page-div-2-game-image" id="user-game-1">
              <img :src='"http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com"+user_game_record.game_img'>
          </div>
          <div class="rank-page-div-2-game-data" id="user-game-2">
            <div id="rank-title-layout">
              {{user_game_record.game_title}}
              </div>
            <div class="rank-data-layout">
              <div>{{rank_text.rank_main_text[0]}}</div>
              <div>{{user_game_record.game_cleartime}}</div>
            </div>
            <div class="rank-data-layout">
              <div>{{rank_text.rank_main_text[1]}}</div>
              <div>{{user_game_record.game_avgtime}}</div>
            </div>
            <div class="rank-data-layout">
              <div>{{rank_text.rank_main_text[2]}}</div>
              <div>{{user_game_record.game_date}}</div>
            </div>
          </div>
      </div>
      <div class="rank-page-div-3">
        <div class="rank-page-div-3-sub-1">
          <bar-chart :chart-data="linedatasets" :width="250" :height="100"></bar-chart>
        </div>
          <div>
            <pie-chart :chart-data="piedatasets" :width="250" :height="99"></pie-chart>
          </div>
          <div class="rank-page-div-3-sub-2">
            <div id="rank-div">
              <div class="rank-div-title">{{rank_text.rank_main_text[3]}}</div>
              <div class="rank-div-contents">
                <div class="rank-div-contents-content" v-for="ranking in user_rank_record">
                  <span style="background:skyblue; color:white">
                  {{ranking.rank}}
                  </span>
                  <span>{{ranking.user_nickname}}</span>
                  <span>{{ranking.clear_time}}</span>
                </div>
              </div>
            </div>
          </div>
        
      </div>
    </div>
    <footers></footers>
    <!--footer area-->
  </div>
</template>
<style src="../css/pentoRank.css"></style>

<script>
//Chartデータを処理するCALSSFILE
import RadarChart from "../js/Radar.js";
import PieChart from "../js/Pie.js";
import BarChart from "../js/Bar.js";
import lang from "../htmltext/text";
import footers from "../template/Footer.vue";
export default {
  components: {
    footers: footers,
    RadarChart: RadarChart,
    PieChart: PieChart,
    BarChart: BarChart
  },
  mounted() {
    window.scrollTo(0, 0);
    this.search_my_play(); //page rendering
  },
  data() {
    return {
      //defualt value setting
      rank_text: lang.rank,
      linedatasets: null,
      piedatasets: null,
      radardatasets: null,
      user_rank_record: [],
      user_game_record: {
        game_img: "/images/web/rank.png",
        game_title: "左のリストから記録を確認しよう",
        game_date: "0",
        game_cleartime: "00：00：00",
        game_avgtime: "0"
      },
      game_record: [],
      rank_btn: null,
      datacolor: ["#6ef864", "#ffba63", "#f86077", "#38a21e", "#d44ac2"]
    };
  },

  methods: {
    //랭크 페이지의 함수 정의
    search_my_play: function() {
      let url = "Rank"; //user game data get
      let art = {
        user_no: sessionStorage.getItem("user_number")
      };
      this.axios.post(url, art).then(response => {
        this.game_record = response.data;
      });
    },
    load_user_play: function(design_no, imgs) {
      //Wait for http respones
      //loading event start
      this.padein();
      this.loding();
      let url = "RankRecordValue";
      let art = {
        user_no: sessionStorage.getItem("user_number"),
        design_no: design_no
      };
      this.axios.post(url, art).then(response => {
        //loading event end
        this.padeout();
        //값 입력
        this.user_game_record.game_img = imgs;
        this.user_game_record.game_title = response.data.title[0].design_title;
        this.user_game_record.game_cleartime =
          response.data.userRecord[0].clear_time;
        this.user_game_record.game_date =
          response.data.userRecord[0].registered_date;
        this.user_game_record.game_avgtime = response.data.avgTime[0].avgTime;
        this.user_rank_record = response.data.userRank;
        this.load_frd_play(this.user_rank_record);
      });
    },
    //loading function
    loding: function() {
      let lodding = document.getElementById("loadding");
      lodding.style.display = "block";
      lodding.style.width = "50px";
      lodding.style.height = "50px";
    },
    padein: function() {
      let lodding2 = document.getElementById("user-game-1");
      let lodding3 = document.getElementById("user-game-2");
      lodding2.style.display = "none";
      lodding3.style.display = "none";
    },
    padeout: function() {
      let lodding = document.getElementById("loadding");
      let lodding2 = document.getElementById("user-game-1");
      let lodding3 = document.getElementById("user-game-2");
      lodding.style.display = "none";
      lodding2.style.display = "block";
      lodding3.style.display = "grid";
    },
    load_frd_play: function(recorddata) {
      let frdname = [];
      let frdrecord = [];
      //テータをPUSH
      recorddata.forEach(function(item) {
        frdname.push(item.user_nickname);
        frdrecord.push(item.put_number);
      });
      this.piedatasets = {
        labels: frdname,
        datasets: [
          {
            backgroundColor: this.datacolor,
            data: frdrecord
          }
        ],
        scale: {
          ticks: {
            min: 50,
            max: 50,
            beginAtZero: false,
            stepSize: 1
          }
        }
      };
      this.linedatasets = {
        labels: frdname,
        datasets: [
          {
            backgroundColor: this.datacolor,
            data: frdrecord
          }
        ],
        scale: {
          ticks: {
            min: 50,
            max: 50,
            beginAtZero: false,
            stepSize: 1
          }
        }
      };
    }
  }
};
</script>
