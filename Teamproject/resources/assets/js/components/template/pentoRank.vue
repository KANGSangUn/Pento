<template>
    <div class="rank-div">
        <div class="rank-menu">
            <div class="menu-title">
                <img src="../imgs/rankpagelogo.png">MY RANK
            </div>
            <div class="menu-board">
                <div v-for="gamelist in game_record" @click="load_user_play(gamelist.Round)">
                    {{gamelist.gametitle}}
                    {{gamelist.Round}}
                </div>
            </div>
        </div>
        <div class="rank-body">
            <div class="rank-body-one">
                <div>{{user_play_games}}</div>
            </div>
            <div class="rank-body-two">
                <div>{{user_play_games}}</div>
            </div>
        </div>
        <div class="rank-frd">
            <div class="frd-board">
                친구순위 테이블
            </div>
            <div>
                <vs-input vs-icon="search" vs-placeholder="Search" v-model="search_frd"/>
            </div>
        </div>
    </div>
</template>
<style src="../css/pentoRank.css"></style>

<script>


    export default {

        mounted() {

        },
        data(){
            return{
                search_rank:[],
                search_frd:'',
                game_record:{
                    dump1: {
                        'Round': '1라운드',
                        'gameimg':'',
                        'gametitle':'펭귄'
                    },
                    dump2: {
                        'Round': '2라운드',
                        'gameimg':'',
                        'gametitle':'오소리'
                    },
                    dump3: {
                        'Round': '3라운드',
                        'gameimg':'',
                        'gametitle':'뱀'
                    },
                    dump4: {
                        'Round': '4라운드',
                        'gameimg':'',
                        'gametitle':'헬기'
                    }

                },
                user_play_games :[],
                frd_rank :[],
            }
        },
        methods :{ //랭크 페이지의 함수 정의
            search_my_play : function () {
                let search_game = search_rank;
                let url=""; //기록 메뉴
                this.axios.post().then((response)=>
                {this.game_record=response.data});
            },
            load_user_play : function (select_game) {
//                let url="";  //나의 현재 기록
//                this.axios.post().then((response)=>
//                {this.user_play_games=response.data});
                this.user_play_games=select_game;
            },
            load_frd_play : function(){
                let url=""; //친구와의 랭킹
                this.axios.post().then((response)=>
                {this.frd_rank=response.data});


            },

        },
    };


</script>