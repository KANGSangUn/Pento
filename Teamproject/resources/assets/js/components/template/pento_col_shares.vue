<template>
    <div class="col-share-main-layout">
        <div class="col-share-banner-layout"></div>
        <div class="col-share-contents-layout">
            <div>

            </div>
            <div class="col-share-list-layout">
                <div v-for="list in all_pento_list"  class="content-layout" @click="pento_all_modal(list.design_no)">
                    <img v-bind:src="list.file_name" class="content-img">
                    <div class="middle" >
                        <div class="text">
                            <h2>펭귄</h2>
                            <p>작성자 : 김펜토</p>
                        </div>
                    </div>
                </div>
            </div>
            <div>

            </div>
        </div>
        <sweet-modal ref="col_modal2" width="60vw" overlay-theme="dark">
            <div class="col-share-modal-layout" v-for="select_pento in select_pento_list">
                <div class="col-share-modal-layout-sub-1">
                    <div>
                        <img src v-bind:src='select_pento.file_name'/>
                    </div>
                </div>
                <div class="col-share-modal-layout-sub-2">
                    <div class="modal-2-sub-1"><div></div>{{select_pento.design_title}}</div>
                    <h4>작성자 : {{select_pento.user_nickname}}</h4>
                    <p>난이도 : {{select_pento.level_of_difficultly}}</p>
                    <span>{{select_pento.design_explain}}</span>
                    <div class="modal-2-sub-4">
                        <button class="modal-btn-1"@click="
                        $vs.notify({title:'구독했습니다!',
                        text:'구독했습니다! 게임에서 만나요!',color:'warning',position:'top-center'})
                        ,buy_pento_col(select_pento.design_no)" vs-type="warning-flat">구독</button>
                        <button class="modal-btn-2"
                                @click="$vs.notify({title:'추천!',
                                text:'추천하셨습니다~고마워요!',color:'danger',icon:'favorite'})"
                                vs-type="danger-flat">추천</button>
                    </div>

                </div>
            </div>
        </sweet-modal>
    </div>
</template>
<script>
    export default{
        created(){
            this.all_pento_page();
        },
        data(){
            return{
                all_pento_list:{},
                select_pento_list:{}, //펜토미노를 선택 할 때 담을 변수
                temp : []
            }
        },
        methods : {
            all_pento_page : function () {//펜토마이페이지 불러버리기~
                let url = 'col_all';
                let art = {
                    'kinds' : 'Page',
                    'page_name' : 'Collection_all'
                };
                this.axios.post(url,art).then(response=>{
                    this.all_pento_list=response.data;
                })
            },
            pento_all_modal : function (design_no) {
                let url = "all_col_pop";
                let art = {
                    'kinds' : 'Page',
                    'category' : 'collection_default',
                    'detailed_value' : design_no
                };
                this.axios.post(url,art).then(
                    response=>{
                        this.select_pento_list=response.data;

                    });

                this.$refs.col_modal2.open();
            },
            buy_pento_col : function (design_no) {
                console.log(design_no);
                let url = "buy_pento_col";
                let art = {
                    'kinds' : 'Contents',
                    'method_id' : 'Subscribe',
                    'category' : 'collection',
                    'detailed_value' : design_no
                };
                this.axios.post(url,art).then(
                    response=>{

                        this.temp=response.data;

                    });

            }
//        <input type="submit" value="컬렉션 구독하기"> O O
//
//    <input type="hidden" value="Contents" name="kinds">
//
//        <input type="hidden" value="Subscribe" name="method_id">
//        <input type="hidden" value="collection" name="category">
//        <input type="hidden" value="1" name="detailed_value">
        },


    }
</script>
<style>
    .col-share-main-layout{
        display: grid;
        height: 100%;
        grid-template-rows: 0.6fr 0.4fr;
    }
    .col-share-banner-layout{
        background-image: url("http://localhost:8000/images/web/col_all_banner.jpg");
        background-size: 100%;
        height: 60vh;
    }
    .col-share-contents-layout{
        display: grid;
        grid-template-columns: 0.1fr 0.8fr 0.1fr;
    }
    .col-share-modal-layout{
        display: grid;
        grid-template-columns: 0.6fr 0.4fr;
        height: auto;
    }
    .modal-btn-1{
        font-size: 1.5vw;
        background-color: white;
        border: 2px #f8b213 solid;
        transition: 0.3s;
    }
    .modal-btn-1:hover{
        color: white;
        background-color: #f8b213;
        border: #f8b213;
    }
    .modal-btn-2{
        font-size: 1.5vw;
        background-color: white;
        border: 2px #f87b7b solid;
        transition: 0.3s;
    }
    .modal-btn-2:hover{
        color: white;
        background-color: #f87b7b;
        border: #f87b7b;
    }
    .col-share-modal-layout img{
        width: 100%;
        height:  100%;
    }
    .col-share-modal-layout-sub-2{
        padding: 1.5vw;
        text-align: left;
        display: grid;
        grid-template-rows: 0.10fr 0.1fr 0.1fr 0.5fr 0.2fr;
    }
    .modal-2-sub-1{
        font-size: 2vw;
        vertical-align: middle;
        border-bottom : 1px solid silver;
    }
    .modal-2-sub-1 div{
        margin-right: 0.5vw;
        float: left;
        width: 5px;
        height: 3vw;
        background-color: orange;
    }
    .modal-2-sub-4{
        display : grid;
        grid-template-columns: 0.5fr 0.5fr;
    }
    .col-share-list-layout{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
    }

    .content-layout{
        position: relative;
    }
    .content-layout img{
        width: 100%;
        height:  100%;
    }
    .content-img{
        opacity: 1;
        display: block;
        width: 100%;
        height: auto;
        transition: .4s ease;
        backface-visibility: hidden;
    }
    .middle {
        transition: .5s ease;
        opacity: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        text-align: center;
    }
    .content-layout:hover{
        display: inline;
    }
    .content-layout:hover .content-img {
        filter : blur(5px);
    }

    .content-layout:hover .middle {
        opacity: 1;
    }
    .content-layout:hover .text {
        background : rgba(0, 0, 0, 0.5);
        border-top: 2vw solid rgba(0, 0, 0, 0.0);
        border-left: 1vw solid rgba(0, 0, 0, 0.0);
        border-bottom: 2vw solid rgba(0, 0, 0, 0.0);
        border-right: 1vw solid rgba(0, 0, 0, 0.0);
        opacity: 1;
    }
    .text {
        transition: .4s ease;
        width: 15vw;
        height: 40%;
        background : rgba(0, 0, 0, 0.5);
        color: white;
        font-size: 1vw;
    }
</style>