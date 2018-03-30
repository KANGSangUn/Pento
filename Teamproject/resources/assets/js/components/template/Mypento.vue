<template>
        <div class="mypento_main_div">
            <div class="mypento_div">
                <vs-tabs vs-color="rgb(72, 150, 2)">
                    <vs-tab vs-label="내 정보"
                            @click="debugsss()"
                            class="mypento_sub_div"
                            id="mypento_sub_div1">
                        <!--유저 기본 정보 div-->
                        <img v-bind:src='"http://localhost:8000/images/"+(Item_list.user_thumnail)' class="userimg"/>
                        <h1>{{Item_list.user_name}}</h1>
                        <h2>{{Item_list.user_id}}</h2>
                        <h2>소개</h2>
                        <h3>{{Item_list.user_introduce}}</h3>
                    </vs-tab>
                    <vs-tab vs-label="나의 친구들"
                            class="mypento_sub_div"
                            id="mypento_sub_div2">
                        <div>
                            <li v-for="frdlist in Item_list.frd_array">
                                {{frdlist}}
                            </li>
                        </div>
                    </vs-tab>
                    <vs-tab vs-label="나의 동화"
                            class="mypento_sub_div"
                            id="mypento_sub_div3">
                        <div>
                            <li v-for="buylist in Item_list.buy">
                                {{buylist}}
                            </li>
                        </div>
                    </vs-tab>
                </vs-tabs>
            </div>
        </div>
</template>
<style src="../css/mypento.css"></style>
<script>

    export default {
        mounted() {
            this.load_user_info();

        },
        data(){
            return {
                Item_list :[]
                //각 항목의 유저의 값을 담을 변수
            }
        },
        methods :  {
            load_user_info : function () {
                //서버로 유저 정보 요청
                let url = '/userinfo';
                this.axios.get(url).then(
                    (response)=>{
                    this.Item_list=response.data;
                })
            }
        }
    }
//


</script>