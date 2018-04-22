<!--
dev . KANG SANG UN
-->
<template>
    <div class="footer-div">
        <div>
           <p>Developers</p>
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
        <div>Project Pento Dev Team Horenso</div>
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
  padding: 3vh;
  text-align: center;
  background: gray;
  width: 100%;
  height: 300px;
  color: white;
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
}
</style>