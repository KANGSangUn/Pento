<template>
    <div class="Pentobox">

        <h1 style="text-align: center">모두의 펜토미노</h1>
        <br/>


        <sweet-modal ref="modal" @click="openModal">
            <div style="width: 500px; height: 400px; align-items: center">
                <div style="float: left; margin-right: 20px">

                    <!-- 받아올Data : 도안image, 제목, 만든날짜 -->
                    <!--<img class="Modal_img" src="../../../../public/images/littlepig.png"/>-->
                </div>
                <div style="float: left">
                    <h4>제목: {{design_title}}</h4>
                    <h4>만든날짜: {{writing_date}}</h4>
                    <h4>작품설명: {{design_explain}}</h4>

                    <br/><br/><br/><br/>
                    <vs-button vs-type="primary-gradient">추천</vs-button> <!-- 추천 수 표시된 영역, 추천누를때 ++1-->
                    <br/><br/>
                    <vs-button vs-type="danger-gradient">삭제</vs-button>
                </div>
            </div>
        </sweet-modal>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                design_title: '제목',
                writing_date: '날짜',
                design_explain: '설명',

                //이미지 파일 정보(좌표값)
//                pento_Design: require('../../../public/images/littlepig.png')
            };
        },
        methods: {
            openModal: function () {
                this.$refs.modal.open();
            }
        }
    }
</script>

<style>

    .Pentobox {
        width: 1600px;
        height: 100%;
        margin: 200px 150px 0 150px;
        display: inline-block;
        float: left;
    }

    .content {
        margin-left: 140px;
        margin-right: 60px;
        margin-bottom: 60px;
        float: none;
        display: inline-block;
    }

    .imgSet, .Modal_img {
        width: 300px;
        height: 400px;
    }

    .imgSet:hover {
        border: 3px solid black;
    }
</style>

