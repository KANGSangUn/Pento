<!--
dev . KANG SANG UN
-->
<style src="../css/storyList.css"></style>
<template>

        <div class="story_main" id="story_main">
            <div class="stp_thumbnail">
                    <p class="stp_thumbnail-p">ものがたり<br>さいこう</p>

                    <button>
                    <scrollactive class="my-nav"
                                  active-class="active"
                                  :offset="50"
                                  :duration="1000"
                                  bezier-easing-value=".5,0,.35,1">
                        <a href="#story-body" class="scrollactive-item">!</a>
                    </scrollactive>
                    </button>
            </div>
            <div class="stp_body" id="story-body">
                <div class="stp_text">
                    <span>STORY LIST</span>
                    <button @click="openBasket()">
                        BASKET
                    </button>
                </div>
                <div class="booklist">
                    <div v-for="list in story" class="list_item" @click='openStory(list)'>
                        <figure class="info_effect">
                            <img v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+(list.tale_image)+'.jpg'"/>
                            <figcaption>
                                <h2>{{list.tale_title}}</h2>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
            <sweet-modal title="BASKET LIST" ref='bkt_modal' overlay-theme="dark" width="50vw">
                <div class="basket">
                  <transition-group name="list" tag="div" id="basket">
                    <div v-for="item_bkt in basket_item"  v-bind:key="item_bkt.tale_title" class="obj-bkt" @click="delect_Item(item_bkt)">
                        <img  v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+(item_bkt.tale_image0)+'.jpg'"/>
                        {{item_bkt.tale_title}}
                    </div>
                  </transition-group>
                </div>
                <div class="basket-price">
                  <span
                  style="font-size:1.5vh;"
                  >클릭 시 장바구니에서 제거 됩니다.</span>
                    총 금액 : {{all_price}}
                    <vs-button vs-type="primary-filled">구매하기</vs-button>
                </div>
            </sweet-modal>
            <sweet-modal ref='modal' overlay-theme="dark" width="50vw" title="Faerie tale">
                <div class="story-modal">
                    <div style="float: left" class="story-modal-left">
                        <div class="story-modal-left-main">
                            <img  v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+(select_item.tale_image0)+'.jpg'"/>
                        </div>
                        <div class="story-modal-left-sub">
                            <div class="story-modal-images" @click="thunail_change(select_item.tale_image1)">
                                <img  v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+(select_item.tale_image1)+'.jpg'"/>
                            </div>
                            <div class="story-modal-images" @click="thunail_change(select_item.tale_image2)">
                                <img  v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+(select_item.tale_image2)+'.jpg'"/>
                            </div>
                            <div class="story-modal-images" @click="thunail_change(select_item.tale_image3)">
                                <img  v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+(select_item.tale_image3)+'.jpg'"/>
                            </div>
                            <div class="story-modal-images" @click="thunail_change(select_item.tale_image4)">
                                <img  v-bind:src="'http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com'+(select_item.tale_image4)+'.jpg'"/>
                            </div>

                        </div>
                    </div>
                    <div class="story-modal-right">
                        <div class="story-modal-right-title">
                            <h2>{{select_item.tale_title}}</h2>
                        </div> <!--제목-->

                        <div class="story-modal-right-info">
                                {{select_item.tale_info}}
                            仲良しそれぞれちがう魅力を持っている子豚三匹！
                            その子豚兄弟の前に怖いウルフがでってきた？！！
                            ウルフと子豚兄弟はどうなるかな！
                            子豚の話を読んでみよう！
                        </div> <!--내용-->
                        <div class="story-modal-right-price">
                            <h2>{{select_item.tale_price}}</h2>
                        </div>
                        <div class="story-modal-right-btn">

                            <vs-button vs-type="success-filled"
                                       @click="alert('success',select_item.fairy_tale_no)">Buy</vs-button>
                            <vs-button
                                    @click="$vs.notify(
                                        {title:'장바구니에 추가 되었습니다.',
                                        text:'최고에요!',
                                        color:'success',
                                        icon:'favorite'}),like_it(select_item)"
                                    vs-type="success-filled">Basket</vs-button>
                        </div> <!--구독버튼-->
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
      story: [], //이야기 리스트 데이터 값을 담는 변수
      select_item: [], //선택한 이야기의 정보를 담는 변수
      basket_item: [], //장바구니 데이터
      backgroundLoading: "#ee9e19",
      temp: "",
      all_price: 0
    };
  },
  mounted() {
    window.scrollTo(0, 0); //페이지를 맨 위로 올리기
    this.page_loading();
    this.storylists(); //선언된 함수를 실행
  },
  methods: {
    page_loading: function() {
      //페이지 로딩
      this.$vs.loading({
        background: this.backgroundLoading,
        color: "rgb(255, 255, 255)"
      });
      setTimeout(() => {
        this.$vs.loading.close();
      }, 1000);
    },
    storylists: function() {
      //함수선언
      let uri = "storypagereq";
      let art = {
        kinds: "Page",
        page_name: "StoryList"
      };
      this.axios.post(uri, art).then(
        //서버로 http통신 요청
        response => {
          //response 받은 값 이야기 정보 함수에 전송
          this.story = response.data;
        }
      );
    },

    openStory: function(items) {
      //동화 클릭시 동화 모달 이벤트 출력
      let url = "storyinfo";
      let art = {
        kinds: "Page",
        category: "story",
        detailed_value: items
      };

      this.axios.post(url, art).then(response => {
        this.select_item = response.data;
      });
      this.$refs.modal.open();
    },
    alert: function(color, story_number) {
      //구독하기 버튼
      let uri = "buystory";
      let art = {
        kinds: "Contents",
        method_id: "Buy",
        category: "tale",
        detailed_value: story_number
      };
      this.axios.post(uri, art).then(response => {
        this.temp = response.data;
      });
      this.$vs.alert({
        title: "구독 완료!",
        text: this.select_item.tale_title + "를 구매하셨습니다!",
        textConfirm: "확인",
        color: color
      });

      this.basket_list_buy(story_number);
    },
    openBasket: function() {
      this.$refs.bkt_modal.open();
    },
    like_it: function(items) {
      //장바구니 넣기 함수
      this.all_price += items.tale_price;
      this.basket_item.push(items);
    },
    basket_list_buy: function(items) {
      let url = "buystory";
      let art = {
        kinds: "Contents",
        category: "Buy",
        detailed_value: items
      };

      this.axios.post(url, art).then(response => {
        this.select_item = response.data;
      });
      //this.basket_item 를 이용한 함수 구현
    },
    delect_Item: function(this_items) {
      //삭제할 동화목록을 없에는 함수
      this.all_price -= this_items.tale_price;
      // const deleteItem = this.basket_item.findIndex(function(item) {
      //   return item.id === this_items.id;
      // });
      const delectitem = this.basket_item.indexOf(this_items);
      this.basket_item.splice(delectitem, 1);
    },
    thunail_change: function(image) {
      this.select_item.tale_image0 = image;
    }
  }
};
</script>

