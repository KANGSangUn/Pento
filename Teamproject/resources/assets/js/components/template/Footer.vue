<!--
dev . KANG SANG UN
-->
<template>
    <div class="footer-div">
        <div class="footer-left">
          
        </div>
        <div class="footer-middle">
                <img src="http://localhost:8000/images/web/main_logo.png">
                <br>
                <a  href="https://github.com/KANGSangUn/Pento">
                <i class="fab fa-vuejs fa-2x"></i>
                <i class="fab fa-laravel fa-2x"></i>
                <i  class="fab fa-github fa-2x" ></i>
                </a>
                <br>
                <p>Developed Team Horenso</p>
        </div>
        <div class="footer-right">
            <p style="border-bottom : 1px solid white">Developers</p>
            Unity 정현우<br>
            Leap Motion 정지민<br>
            Arduino 최요한<br>
            Database 성경임<br>
            Back-end 김영문<br>
            Front-end 강상운
        </div>
        <!-- 두번째 줄 -->
    
    </div>
</template>

<style>
.footer-div {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  margin-top: 1vh;
  text-align: center;
  background: gray;
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