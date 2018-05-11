<!--
dev . KANG SANG UN
-->
<style src="../css/storyList.css"></style>
<template>
  <div class="story_main" id="story_main">
    <div class="stp_thumbnail">
      <p class="stp_thumbnail-p">ものがたり<br>さいこう</p>
      <!--상단 배너 -->
    </div>
    <div class="stp_body" id="story-body">
      <div class="stp_text">
        <!--리스트의 장바구니 메뉴와 타이틀 -->
        <span>STORY LIST</span>
        <button @click="openBasket()">
                          BASKET
                </button>
      </div>
      <!-- 동화 리스트 출력 -->
      <div class="booklist">
        <div v-for="list in story" class="list_item" @click='openStory(list)'>
          <figure class="info_effect">
            <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+(list.tale_image)" />
            <figcaption>
              <h2>{{list.tale_title}}</h2>
            </figcaption>
          </figure>
        </div>
      </div>
    </div>
    <!-- 장바구니 리스트 출력 -->
    <sweet-modal title="BASKET LIST" ref='bkt_modal' overlay-theme="dark" width="50vw">
      <div class="basket">
        <transition-group name="list" tag="div" id="basket">
          <!-- 동화 삭제 애니메이션을 위한 트렌지션 그룹 -->
          <div v-for="item_bkt in basket_item" v-bind:key="item_bkt.title" class="obj-bkt" @click="delect_Item(item_bkt)">
            <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+(item_bkt.tale_image0)" /> {{item_bkt.title}}
          </div>
        </transition-group>
      </div>
      <div class="basket-price">
        <span style="font-size:1.5vh;">클릭 시 장바구니에서 제거 됩니다.</span> 총 금액 : {{all_price}}
        <!-- 총 금액 !!!!!!!!!!함수가 가끔식 고장남 고치기 -->
        <vs-button vs-type="primary-filled" @click="basket_list_buy(basket_item)">구매하기</vs-button>
      </div>
    </sweet-modal>
    <!-- 동화 상세정보 출력 -->
    <sweet-modal ref='modal' overlay-theme="dark" width="50vw" title="Faerie tale">
      <div class="story-modal">
        <div style="float: left" class="story-modal-left">
  
          <div class="story-modal-left-main">
            <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+(select_item.tale_image0)" />
          </div>
          <div class="story-modal-left-sub">
            <div class="story-modal-images" @click="thunail_change(select_item.tale_image1)">
              <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+(select_item.tale_image1)" />
            </div>
            <div class="story-modal-images" @click="thunail_change(select_item.tale_image2)">
              <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+(select_item.tale_image2)" />
            </div>
            <div class="story-modal-images" @click="thunail_change(select_item.tale_image3)">
              <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+(select_item.tale_image3)" />
            </div>
            <div class="story-modal-images" @click="thunail_change(select_item.tale_image4)">
              <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+(select_item.tale_image4)" />
            </div>
          </div>
        </div>
        <div class="story-modal-right">
          <div class="story-modal-right-title">
            <h2>{{select_item.title}}</h2>
          </div>
          <!--제목-->
  
          <div class="story-modal-right-info">
            {{select_item.tale_explain}}
  
          </div>
          <!--내용-->
          <div class="story-modal-right-price">
            <h2>{{select_item.tale_price}}</h2>
          </div>
          <div class="story-modal-right-btn">
  
            <vs-button vs-type="success-filled" @click="alert('success',select_item.fairy_tale_no)">Buy</vs-button>
            <vs-button @click="$vs.notify(
                                          {title:'장바구니에 추가 되었습니다.',
                                          text:'최고에요!',
                                          color:'success',
                                          icon:'favorite'}),like_it(select_item)" vs-type="success-filled">Basket</vs-button>
          </div>
          <!--구독버튼-->
        </div>
      </div>
    </sweet-modal>
    <footers></footers>
  </div>
</template>
<script>
import footers from "../template/Footer.vue";
export default {
  components: {
    footers: footers
  },
  data() {
    return {
      story: [],
      select_item: [],
      story_list_no: [],
      basket_item: [],
      backgroundLoading: "#ee9e19",
      temp: "",
      all_price: 0
    };
  },
  mounted() {
    window.scrollTo(0, 0); //pento Page default scroll View
    this.page_loading(); //lazy loading function
    this.storylists(); //story page rendering
  },
  methods: {
    page_loading: function() {
      //Lazy loading
      this.$vs.loading({
        background: this.backgroundLoading,
        color: "rgb(255, 255, 255)"
      });
      setTimeout(() => {
        this.$vs.loading.close();
      }, 1000);
    },
    storylists: function() {
      let uri = "StoryList";
      this.axios.post(uri).then(
        //server http request
        response => {
          //get response data
          //set data
          this.story = response.data;
        }
      );
    },

    openStory: function(items) {
      //item click in modal
      let url = "StoryValue";
      let art = {
        story_no: items
      };

      this.axios.post(url, art).then(response => {
        this.select_item = response.data;
      });

      this.$refs.modal.open();
    },
    alert: function(color, story_number) {
      //buy function
      let uri = "Buy";
      let art = {
        story_no: story_number,
        user_no: sessionStorage.getItem("user_number")
      };
      this.axios.post(uri, art).then(response => {
        this.temp = response.data;
      });
      this.$vs.alert({
        title: "구매 완료!",
        text: this.select_item.tale_title + "를 구매하셨습니다!",
        textConfirm: "확인",
        color: color
      });
    },
    openBasket: function() {
      this.$refs.bkt_modal.open();
    },
    like_it: function(items) {
      //item in basket
      this.story_list_no.push(items.fairy_tale_no);
      this.all_price += items.tale_price;
      this.basket_item.push(items);
    },
    basket_list_buy: function(items) {
      //  buy the basket list
      let uri = "Buylists";
      let art = {
        story_no: this.story_list_no,
        user_no: sessionStorage.getItem("user_number")
      };
      this.axios.post(uri, art).then(response => {
        this.temp = response.data;
      });

      this.$vs.alert({
        title: "구매 완료!",
        text: "구매하셨습니다!",
        textConfirm: "확인",
        color: "success"
      });
      this.basket_item = [];
      this.story_list_no = [];
      this.all_price = 0;
      this.$refs.bkt_modal.close();
      //basket list default setting
    },
    delect_Item: function(this_items) {
      //delect in basket in item
      this.all_price -= this_items.tale_price;
      const delectitem = this.basket_item.indexOf(this_items);
      this.basket_item.splice(delectitem, 1);
    },
    thunail_change: function(image) {
      this.select_item.tale_image0 = image;
    }
  }
};
</script>

