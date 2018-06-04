<!-- 
  dev . Kang sangun
 -->
<template>
  <div class="pento-router">
    <!--My Pento Page rendering-->
    <div class="pento-router-body">
      <router-link :to="{name:'pento_col_my'}">
        <div class="col-menu">
          <div class="menu-sub">
            <img src="http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/mypentoimg.png">
            <br>
            <span>{{collection_text.collection_main_text[0]}}</span>
          </div>
        </div>
      </router-link>
      <!--All pento Page rendering-->
      <router-link :to="{name:'pento_col_all'}">
        <div class="col-menu">
          <div class="menu-sub">
            <img src="http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/allpentoimg.png">
            <br>
            <span>{{collection_text.collection_main_text[1]}}</span>
          </div>
        </div>
      </router-link>
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
  data() {
    return {
      collection_text: lang.collection
    };
  },
  //pento Page default scroll View
  created() {
    window.scrollTo(0, 0);
  }
};
</script>

<style>
.pento-router {
  background-image: url("http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/collection_main.jpg");
  width: 100%;
  background-size: contain;
  height: auto;
}
.pento-router-body {
  padding-top: 20vh;
  margin: auto auto 20vh auto;
  width: 80vw;
  height: auto;
  display: grid;
  grid-column-gap: 1vw;
  grid-template-columns: 1fr 1fr;
}
.col-menu {
  color: rgb(8, 9, 43);
  background: white;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  transition: 0.5s;
}
.col-menu:hover {
  box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}
.menu-sub {
  padding: 1vw;
  text-align: center;
  font-size: 2vw;
}
.menu-sub span {
  font-weight: 400;
  font-family: "Mplus 1p", sans-serif;
}
.col-menu:hover {
  color: white;
  background: blueviolet;
}
</style>