<!-- 
  dev . Kang sangun
 -->
<template>
  <div class="col-my-page">
    <div class="col-my-main-div">
      <div id="my-main-banner">
        <p v-for='banner_text in mycol_text.collection_my_banner_text'>
        {{banner_text}}
        </p>
      </div>
      <div class="my-main-pento-list">
        <div id="my-main-list">
          <div v-for="pento_imgs in pento_list" @click="pento_my_modal(pento_imgs.design_no)">
            <img src v-bind:src='pento_imgs.design_image' />
          </div>
        </div>
      </div>
      <sweet-modal ref="col_modal" width="60vw" overlay-theme="dark">
        <div class="col-my-modal-layout" v-for="select_pento in select_pento_list.design_info">
          <div class="col-my-modal-layout-sub-1">
            <div>
              <img src v-bind:src='select_pento.design_image' />
            </div>
  
          </div>
          <div class="col-my-modal-layout-sub-2">
            <table>
              <tr class="my-modal-layout-tr-tilte">
                <td height="15%" colspan="2">
                  <div class="title-box"></div>
                  {{select_pento.design_title}}</td>
              </tr>
              <tr height="7%" class="my-modal-layout-tr-index">
                <td width="50%">
                  {{mycol_text.collection_my_item_text[0]}} - {{select_pento.user_nickname}}
                  </td>
                <td>
                  {{mycol_text.collection_my_item_text[1]}} - {{select_pento_list.recommendNumSum}}
                  </td>
              </tr>
              <tr height="7%" class="my-modal-layout-tr-index">
                <td colspan="2">
                  {{mycol_text.collection_my_item_text[2]}} - {{select_pento.registered_date}}
                  </td>
              </tr>
              <tr class="my-modal-layout-tr-index-2">
                <td colspan="2">
                  {{select_pento.design_explain}}
                </td>
              </tr>
            </table>
          </div>
        </div>
      </sweet-modal>
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
  created() {
    window.scrollTo(0, 0);
    this.my_pento_page();
  },
  data() {
    return {
      mycol_text: lang.collection,
      pento_list: "", //펜토미노 페이지 값을 담을 변수
      select_pento_list: {} //펜토미노를 선택 할 때 담을 변수
    };
  },
  methods: {
    my_pento_page: function() {
      //펜토마이페이지 불러버리기~
      let url = "MyCollection";
      let art = {
        user_no: sessionStorage.getItem("user_number")
      };
      this.axios.post(url, art).then(response => {
        this.pento_list = response.data;
      });
    },
    pento_my_modal: function(design_no) {
      let url = "CollectionValue";
      let art = {
        design_no: design_no
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
  height: auto;
}
#my-main-banner {
  color: white;
  font-size: 7vh;
  padding-top: 15vh;
  background-image: url("http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/col_my_page_banner.jpg");
  background-size: cover;
}
#my-main-banner p {
  padding-left: 4vh;
  font-weight: 200;
  font-family: "Mplus 1p", sans-serif;
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
  grid-template-columns: 0.5fr 0.5fr;
}
.col-my-modal-layout-sub-1 {
  border-bottom: 1px solid silver;
}
.col-my-modal-layout-sub-1 img {
  width: 100%;
  height: 100%;
}
.title-box {
  margin-right: 0.5vw;
  float: left;
  width: 5px;
  height: 3vw;
  background-color: orange;
}
.col-my-modal-layout-sub-2 {
  height: auto;
}
.modal-btn {
  padding: 1vh;
  color: white;
  float: right;
  border-radius: 0%;
  background: tomato;
  font-size: 2vh;
  transition: 0.3s;
}
.col-my-modal-layout-sub-2 table {
  text-align: left;
  margin: auto;
  padding: 2vh;
  width: 90%;
  height: 100%;
}

.col-my-modal-layout-sub-2 td {
  vertical-align: baseline;
}
.my-modal-layout-tr-tilte {
  font-size: 4vh;
}
.my-modal-layout-tr-index {
  font-size: 2vh;
}
.my-modal-layout-tr-index-2 {
  text-align: left;
}
</style>