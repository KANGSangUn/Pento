<template>
    <div class="col-my-main-div">
        <div id="my-main-banner">이곳은 배너 입니다.</div>
        <div id="my-main-list">
            <div v-for="pento_imgs in pento_list">
                <img src v-bind:src='pento_imgs.file_name'/>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        created(){
            this.my_pento_page();
        },
        data(){
            return {
                pento_list: '', //펜토미노 페이지 값을 담을 변수
                select_pento_list:'', //펜토미노를 선택 할 때 담을 변수
            }
        },
        methods : {
           my_pento_page : function () {//펜토마이페이지 불러버리기~
               let url = 'col_my';
               let art = {
                   'kinds' : 'Page',
                   'page_name' : 'Collection'
               };
               this.axios.post(url,art).then(response=>{
                   this.pento_list=response.data;
               })
           }
        }
    }
</script>
<style>
    .col-my-main-div{
        display : grid;
        grid-template-columns: 0.3fr 0.7fr;
        height:95vh;
    }
    #my-main-banner{
        background-color: #e7827c;

    }
    #my-main-list{
        padding: 1vw;
        margin: 2vw auto;
        text-align: center;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        grid-column-gap: 0.5vw;
        grid-row-gap: 0.5vw;
        transition: 0.5s;
    }
    #my-main-list img{
        margin:30% auto;
        text-align: center;
        width: 100%;
        height: 100%;
    }
    #my-main-list div{
        transition: 0.5s;
    }
    #my-main-list div:hover{
        background-color: #ffb90a;
    }

</style>