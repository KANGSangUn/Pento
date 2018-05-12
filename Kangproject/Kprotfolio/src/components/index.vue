<template>
  <div class="main-page-view">
      <div>
        asd
      </div>
      <div>
        Hello World!
      </div>
  </div>
</template>

<script>
export default {};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
@import url("https://fonts.googleapis.com/css?family=Shadows+Into+Light+Two");
.main-page-view {
  height: 100vh;
  display: grid;
  grid-template-columns: 0.1fr 0.9fr;
}

.main-page-view > div:nth-child(1) {
  background: blue;
}

.main-page-view > div:nth-child(2) {
  padding: 10%;
  text-align: right;
  font-family: "Shadows Into Light Two", cursive;
  font-size: 7vw;
  color: white;
  background: #34314c;
}
</style>
