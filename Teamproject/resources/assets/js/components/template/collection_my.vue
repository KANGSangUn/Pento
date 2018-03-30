<template>
    <div class="Pentobox">
        <h1 style="text-align: center">나만의 펜토미노</h1>
        <br/>
        <!-- 도안이 포함된 div태그 -->
        <!-- 도안 1개당 content div추가(+이미지, 설명)-->
        <!-- 도안3개 마다 끊기 -->


        <sweet-modal ref="modal" @click="openModal">
            <div style="width: 500px; height: 400px; align-items: center">
                <div style="float: left; margin-right: 20px">

                    <!-- 받아올Data : 도안image, 제목, 만든날짜 -->
                    <!--<img class="Modal_img" :src="pento_Design"/>-->
                </div>
                <div style="float: left">
                    <h4>제목: {{design_title}}</h4>
                    <h4>만든날짜: {{writing_date}}</h4>

                    <br/><br/><br/><br/>
                    <br/><br/>
                    <vs-button vs-type="danger-gradient" @click="deleteCollection">삭제</vs-button>
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
//                pento_Design: require('../../../public/images/littlepig.png'),//캔버스화 한 도안
            }
        },
        methods: {
            openModal: function () {
                this.$refs.modal.open();
            },

            deleteCollection: function () {

            },
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