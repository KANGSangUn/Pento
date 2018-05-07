<template>
    <div class="col-share-main-layout">
        <!-- banner layout -->
        <div class="col-share-banner-layout">
            <div id='col-share-banner-sub-1'>
                <p>PENTOPENTO</p>
                <p>PENTOPENTO</p>
                <p>PENTOPENTO</p>
                <p>PENTOPENTO</p>
            </div>
            <div id='col-share-banner-sub-2'></div>
        </div> 
        <!-- contents layout -->
        <div class="col-share-contents-layout">
            <div></div>
            <div class="col-share-list-layout">
                <div v-for="list in all_pento_list"  class="content-layout" @click="pento_all_modal(list.design_no)">
                    <div class="content-index">
                        <span>{{list.design_title}}</span>
                        <hr style="color : white;">
                        <p>작성자 : {{list.nickname}}</p>
                        <p>난이도 : {{list.level}}</p>
                    </div>
                    <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+list.design_image" class="content-img">
                </div>
            </div>
            
            <div></div>
        </div>
        <br>
        <sweet-modal ref="col_modal2" width="60vw" overlay-theme="dark">
            <div class="col-share-modal-layout" v-for="select_pento in select_pento_list.design_info">
                <div class="col-share-modal-layout-sub-1">
                    <div>
                        <img src v-bind:src='select_pento.design_image'/>
                    </div>
                </div>
                <div class="col-share-modal-layout-sub-2">
                    <div class="modal-2-sub-1"><div></div>{{select_pento.design_title}}</div>
                    <h4>작성자 : {{select_pento.user_nickname}}</h4>
                    <p>난이도 : {{select_pento_list.recommendNumSum}}</p>
                    <p>제작일 : {{select_pento.registered_date}}</p>
                    <span>{{select_pento.design_explain}}</span>
                    <div class="modal-2-sub-4">
                        <button class="modal-btn-1" @click="
                        $vs.notify({title:'구독했습니다!',
                        text:'구독했습니다! 게임에서 만나요!',color:'warning',position:'top-center'})
                        ,buy_pento_col(select_pento.design_no)" vs-type="warning-flat">구독</button>
                        
                   
                  </div>
                </div>
                <div class="col-share-modal-layout-sub-3">
                  <span>皆の作品</span>
                  <div v-for="user_pento in select_pento_list.side_image"　
                  class="col-share-modal-layouy-sub-3-img" @click="user_design_pento(user_pento)">
                    <img src v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+user_pento.imitated_image"/>
                  </div>
                </div>
          </div>
        </sweet-modal>
        <sweet-modal  ref="user_pento" overlay-theme="dark">
          <div class="user_design_pento_modal">
            <div>
            <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+user_design_list.imitated_image">
            </div>
            <div>
              <p>{{user_design_list.design_title}}</p>
              <p>{{user_design_list.user_nickname}}</p>
            <span> Hit : {{user_design_list.reNum}}</span>
           <button class="modal-btn-2"
            @click="$vs.notify({title:'추천!',
            text:'추천하셨습니다~고마워요!',color:'danger',icon:'favorite'}),lisk_it(user_design_list.imitated_no)"
            vs-type="danger-flat">추천</button>
            </div>
          </div>
        </sweet-modal>
        <!-- footer -->
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
    this.all_pento_page();
  },
  data() {
    return {
      all_pento_list: {},
      select_pento_list: {}, //펜토미노를 선택 할 때 담을 변수
      temp: [],
      user_design_list: []
    };
  },
  methods: {
    all_pento_page: function() {
      //펜토마이페이지 불러버리기~
      let url = "EveryCollection";

      this.axios.post(url).then(response => {
        this.all_pento_list = response.data;
      });
    },
    pento_all_modal: function(design_no) {
      let url = "CollectionValue";
      let art = {
        design_no: design_no
      };
      this.axios.post(url, art).then(response => {
        this.select_pento_list = response.data;
      });

      this.$refs.col_modal2.open();
    },
    buy_pento_col: function(design_no) {
      console.log(design_no);
      let url = "Buy";
      let art = {
        design_no: design_no,
        user_no: sessionStorage.getItem("user_number")
      };
      this.axios.post(url, art).then(response => {
        this.temp = response.data;
      });
    },
    user_design_pento: function(temp) {
      this.user_design_list = temp;
      this.$refs.user_pento.open();
    },
    lisk_it: function(design_no) {
      let url = "Recommend";
      let art = {
        design_no: design_no,
        user_no: sessionStorage.getItem("user_number")
      };
      this.axios.post(url, art).then(response => {
        this.temp = response.data;
      });
    }
  }
};
</script>
<style>
.col-share-main-layout {
  display: grid;
  grid-template-rows: 0.4fr 0.6fr 0.3fr;
}
.col-share-banner-layout {
  margin: 50px auto;
  display: grid;
  grid-template-columns: 0.3fr 1fr;
  width: 100vw;
  height: 60vh;
}
#col-share-banner-sub-1 {
  color: white;
  padding: 5vh;
  font-size: 4vw;
  background: purple;
}
#col-share-banner-sub-2 {
  background-image: url("http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/col_all_banner.jpg");
  background-size: cover;
  background-repeat: no-repeat;
}
.col-share-contents-layout {
  height: auto;
  display: grid;
  grid-template-columns: 0.1fr 0.8fr 0.1fr;
}
.col-share-modal-layout {
  display: grid;
  grid-template-columns: 40% 40% 20%;
  height: 48vh;
}
.modal-btn-1 {
  font-size: 1.5vw;
  background-color: white;
  border: 2px #f8b213 solid;
  transition: 0.3s;
}
.modal-btn-1:hover {
  color: white;
  background-color: #f8b213;
  border: #f8b213;
}
.modal-btn-2 {
  font-size: 1.5vw;
  background-color: white;
  border: 2px #f87b7b solid;
  transition: 0.3s;
}
.modal-btn-2:hover {
  color: white;
  background-color: #f87b7b;
  border: #f87b7b;
}
.col-share-modal-layout img {
  width: 100%;
  height: 100%;
}
.col-share-modal-layout-sub-2 {
  padding: 1.5vw;
  text-align: left;
  display: grid;
  grid-template-rows: 0.1fr 0.1fr 0.1fr 0.1fr 0.5fr 0.2fr;
}
.col-share-modal-layout-sub-3 {
  overflow-y: auto;
}
.col-share-modal-layouy-sub-3-img {
  padding: 2vh;
  transition: 0.3s;
}
.col-share-modal-layouy-sub-3-img img {
  border-radius: 10px;
}
.col-share-modal-layouy-sub-3-img:hover {
  background: orange;
}
.modal-2-sub-1 {
  font-size: 2vw;
  vertical-align: middle;
  border-bottom: 1px solid silver;
}
.modal-2-sub-1 div {
  margin-right: 0.5vw;
  float: left;
  width: 5px;
  height: 3vw;
  background-color: orange;
}
.modal-2-sub-4 {
  display: grid;
  grid-template-columns: 0.5fr 0.5fr;
}
.col-share-list-layout {
  display: grid;
  grid-column-gap: 1vh;
  grid-row-gap: 1vh;
  grid-template-columns: 0.25fr 0.25fr 0.25fr 0.25fr;
}

.content-layout {
  position: relative;
}
.content-index {
  padding: 2vh;
  overflow: hidden;
  z-index: 10;
  color: transparent;
  position: absolute;
  width: 0px;
  background: transparent;
  height: 100%;
  transition: 0.35s;
}
.content-index span {
  font-size: 2vh;
}
.content-layout:hover .content-img {
  filter: blur(4px);
}
.content-layout:hover .content-index {
  color: white;
  display: inline-block;
  background: rgba(10, 30, 180, 0.5);
  width: 50%;
}

.content-img {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: 0.4s ease;
  backface-visibility: hidden;
}
.user_design_pento_modal {
  display: grid;
  grid-template-columns: 50% 50%;
}
</style>