<template>
<div class="col-my-page">
    <div class="col-my-main-div">
        <div id="my-main-banner">
            あなたが<br>
            作った<br>
            選んだ<br>
            ペントを<br>
            見よう。
        </div>
        <div class="my-main-pento-list">
            <div id="my-main-list">
                <div v-for="pento_imgs in pento_list" @click="pento_my_modal(pento_imgs.design_no)">
                    <img src v-bind:src='pento_imgs.file_name'/>
                </div>
            </div>
        </div>
        <sweet-modal ref="col_modal" width="60vw" overlay-theme="dark">
            <div class="col-my-modal-layout" v-for="select_pento in select_pento_list">
                <div class="col-my-modal-layout-sub-1">
                    <div>
                    <img src v-bind:src='select_pento.file_name'/>
                    </div>
                </div>
                <div class="col-my-modal-layout-sub-2">
                    <h2>{{select_pento.design_title}}</h2>
                    <h4>작성자 : {{select_pento.user_nickname}}</h4>
                    <p>난이도 : {{select_pento.level_of_difficultly}}</p>
                    <span>{{select_pento.design_explain}}</span>
                </div>
            </div>
        </sweet-modal>
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
    this.my_pento_page();
  },
  data() {
    return {
      pento_list: "", //펜토미노 페이지 값을 담을 변수
      select_pento_list: {} //펜토미노를 선택 할 때 담을 변수
    };
  },
  methods: {
    my_pento_page: function() {
      //펜토마이페이지 불러버리기~
      let url = "col_my";
      let art = {
        kinds: "Page",
        page_name: "Collection"
      };
      this.axios.post(url, art).then(response => {
        this.pento_list = response.data;
      });
    },
    pento_my_modal: function(design_no) {
      let url = "my_col_pop";
      let art = {
        kinds: "Page",
        category: "collection_default",
        detailed_value: design_no
      };
      this.axios.post(url, art).then(response => {
        this.select_pento_list = response.data;
      });

      this.$refs.col_modal.open();
    }
  }
};
</script>
<style>
@import url("https://fonts.googleapis.com/earlyaccess/mplus1p.css");

.col-my-page {
  height: 100%;
  width: 100%;
}
.col-my-main-div {
  display: grid;
  grid-template-columns: 0.3fr 0.7fr;
  height: 100%;
}
#my-main-banner {
  font-weight: 200;
  font-family: "Mplus 1p", sans-serif;
  color: white;
  font-size: 7vh;
  padding-top: 15vh;
  background-image: url("http://localhost:8000/images/web/col_my_page_banner.jpg");
  background-size: cover;
}
#my-main-list {
  padding-top: 5vh;
  text-align: center;
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr;
  transition: 0.5s;
}
#my-main-list img {
  border-radius: 10%;
  text-align: center;
  width: 100%;
  height: 100%;
}
#my-main-list div {
  padding: 1vw;
  transition: 0.5s;
}
#my-main-list div:hover {
  background-color: orange;
}
.col-my-modal-layout {
  height: auto;
  display: grid;
  grid-template-rows: 0.5fr 0.5fr;
}
.col-my-modal-layout-sub-1 {
  border-bottom: 1px solid silver;
}
.col-my-modal-layout-sub-1 img {
  padding: 1.5vw;
  width: 40%;
  height: 50%;
}
</style>