<!--
dev . KANG SANG UN
-->
<template>
    <div class="footer-div">
        <div class="footer-left">
          
        </div>
        <div class="footer-middle">
          <img src="http://ec2-13-125-219-201.ap-northeast-2.compute.amazonaws.com/images/web/main_logo.png">
            <br>
            
            <i class="fab fa-vuejs fa-2x"></i>
            <i class="fab fa-laravel fa-2x"></i>
            <a  href="https://github.com/KANGSangUn/Pento">
            <i  class="fab fa-github fa-2x" ></i>
            </a>
            <br>
            <p>{{footer_text_1}}</p>
        </div>
        <div class="footer-right">
            <p style="border-bottom : 1px solid white">{{footer_text_2}}</p>   
            <ul>
              <li v-for="(dev,key) in dev_names">
                  {{key}}  {{dev}}
              </li>
            </ul>
        </div>
        <!-- 두번째 줄 -->
    
    </div>
</template>
<script>
import lang from "../htmltext/text";
export default {
  data() {
    return {
      //HTML에 배치될 텍스트
      footer_text_1: lang.footer["footer_text_1"],
      footer_text_2: lang.footer["footer_text_2"],
      dev_names: lang.footer["dev_name"]
    };
  }
};
</script>

<style scoped>
.footer-div {
  background-image: url("http://localhost:8000/images/newimage/footer01.jpg");
  position: relative;
  bottom: 0;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  text-align: center;
  width: 100%;
  height: auto;
  color: white;
  display: grid;
  grid-template-rows: 0.9fr 0.1fr;
  grid-template-columns: 1fr 1fr 1fr;
}
.footer-left {
  font-size: 2vh;
  text-align: left;
  padding: 5vh;
}
.footer-middle {
  padding: 5vh;
}
.footer-right {
  font-size: 2vh;
  text-align: right;
  padding: 4vh;
}
.footer-middle i {
  color: white;
  margin: 2vh 1vh 2vh 1vh;
}
</style>

