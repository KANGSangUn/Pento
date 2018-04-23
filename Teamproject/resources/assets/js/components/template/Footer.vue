<!--
dev . KANG SANG UN
-->
<template>
    <div class="footer-div">
        <div>
           <p>Developer</p>
            <ul>
                <li v-for="name in team_member">
                    {{name}}
                </li>
            </ul>
        </div>
        <div>
        </div>
        <div>
        </div>
        <!-- 두번째 줄 -->
        <div></div>
        <div style="font-size:3vh;">
        <p style="font-size:1.5vh;">Developement by Horenso</p>
        <i class="fab fa-css3-alt"></i>
        <i class="fab fa-html5"></i>
        <i class="fab fa-js"></i>
        <i class="fab fa-vuejs" ></i>
        <i class="fab fa-laravel "></i>
        <i class="fab fa-node "></i>
        <i class="fab fa-aws "></i>
        <a  href="https://github.com/KANGSangUn/Pento">
        <i  class="fab fa-github"></i>
        </a>
        </div>
        <div></div>
    </div>
</template>
<script>
export default {
  data() {
    return {
      team_member: ["정현우", "최요한", "강상운", "김영문", "성경임", "정지민"]
    };
  }
};
</script>
<style>
.footer-div {
  margin-top: 1vh;
  padding: 1vh;
  text-align: center;
  background: gray;
  width: 100%;
  height: 300px;
  color: white;
  display: grid;
  grid-template-rows: 0.9fr 0.1fr;
  grid-template-columns: 1fr 1fr 1fr;
}
</style>