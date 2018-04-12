<!--
dev . KANG SANG UN
-->
<template>
        <div class="mypento_main_div">
            <div class="mypento_div">
                <vs-tabs vs-color="rgb(72, 150, 2)">
                    <vs-tab vs-label="내 정보"
                            @click="debugsss()"
                            class="mypento_sub_div"
                            id="mypento_sub_div1"
                            >
                        <!--유저 기본 정보 div-->
                        <div v-for="user_info in Item_list">
                            <!--<img v-bind:src='"http://localhost:8000/images/users/userimg.png"' class="userimg"/>-->
                            <h1>{{user_info.user_nickname}}</h1>
                            <h2>{{user_info.user_point}}</h2>

                        </div>
                        <div v-for="user_info in Item_list">
                            <h2>소개</h2>
                            <h2>{{user_info.user_intro}}</h2>
                        </div>
                    </vs-tab>
                    <vs-tab vs-label="나의 친구들"
                            class="mypento_sub_div"
                            id="mypento_sub_div2">
                        <div class="my-frd-one">

                        </div>
                        <div>
                            <li v-for="frdlist in frd_list">
                                {{frdlist.user_nickname}}
                            </li>
                        </div>
                    </vs-tab>
                    <vs-tab vs-label="나의 동화"
                            class="mypento_sub_div"
                            id="mypento_sub_div3">
                        <div>
                            <li v-for="buylist in buy_list">
                                {{buylist}}
                            </li>
                        </div>
                        <div class="booklistpage">

                        </div>
                    </vs-tab>

                </vs-tabs>
            </div>
            <footers></footers>
        </div>
</template>

<style src="../css/mypento.css"></style>
<script>

    import footers from '../template/Footer.vue';
    export default {
        components : {

            'footers' : footers
        },
        mounted() {
            this.load_user_info();
            this.load_user_frd();
            this.load_user_story();
        },
        data(){
            return {
                Item_list :'',
                frd_list : [],
                buy_list : []
                //각 항목의 유저의 값을 담을 변수
            }
        },
        methods :  {
            load_user_info : function () {
                //서버로 유저 정보 요청
                let url = 'pentomyuser';
                let art ={
                    'kinds':'Page',
                    'page_name':'MyInfo'
                };
                this.axios.post(url,art).then(
                    (response)=>{
                    this.Item_list=response.data;
                })
            },
            load_user_frd : function () {
                let url = 'pentomyfrd';
                let art = {
                    'kinds' : 'Page',
                    'page_name' : 'Friends'
                };
                this.axios.post(url,art).then(
                    (response)=>{
                        this.frd_list=response.data;
                    })
            },
            load_user_story : function () {
                let url = 'user_story';
                let art = {
                    'kinds' : 'Page',
                    'page_name' : 'BuyList'
                }
                this.axios.post(url,art).then(
                    (response)=>{
                        this.buy_list=response.data;
                    })
            }
        }
    }
//


</script>