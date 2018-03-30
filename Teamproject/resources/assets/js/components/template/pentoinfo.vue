<template>
    <div class="info_main">

       <div class="info_sub1" id="info_main">
            dasdasasdasd
           <scrollactive
                   active-class="active"
                   :offset="0"
                   :duration="1000"
                   bezier-easing-value=".5,0,.35,1">
               <a href="#info_main2" class="scrollactive-item">
               asdsa</a>
           </scrollactive>
       </div>

        <div class="info_sub2" id="info_main2">
            dasdasasdasd
            <scrollactive
                    active-class="active"
                    :offset="0"
                    :duration="1000"
                    bezier-easing-value=".5,0,.35,1">
                <a href="#main" class="scrollactive-item">
                    asdsa</a>
            </scrollactive>
        </div>
    </div>
</template>

<script>
    export default {}
</script>
<style>
.info_main{
    width: 100%;
    height: 110%;
}
.info_sub1{
    width: 100%;
    height: 100%;
    background-color: #958aec;
}
.info_sub2{
    width: 100%;
    height: 100%;
    background-color: #76ec84;
}
</style>