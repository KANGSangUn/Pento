<script src="../js/story.js"></script>
<style src="../css/storyList.css"></style>

<template>
        <div class="story_main">
            <div class="stp_thumbnail">
                <p>「Pento」でしか会えない、</p>
                <p>特別な物語。</p>
            </div>
            <div class="stp_body">
                <div class="stp_text">STORY LIST
                    <vs-button vs-type="success-filled" style="float: right" @click="openBasket()">장바구니</vs-button>
                </div>
                <div class="booklist">
                    <div v-for="list in story" class="list_item" @click='openStory(list)'>
                        <figure class="info_effect">
                            <img v-bind:src='"http://localhost:8000/images/"+(list.tale_image_array)'/>
                            <figcaption>
                                <h2>{{list.tale_title}}</h2>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
            <sweet-modal title="BASKET LIST" ref='bkt_modal' overlay-theme="dark">
                <div class="basket">
                    <div v-for="item_bkt in basket_item" class="obj_bkt">
                        <img  v-bind:src='"http://localhost:8000/images/"+(item_bkt.tale_image_array)'/>
                        {{item_bkt.tale_title}}
                    </div>
                </div>
                <div>
                    총 금액 : 800원
                    <vs-button vs-type="primary-filled">구매하기</vs-button>
                </div>
            </sweet-modal>
            <sweet-modal  ref='modal' overlay-theme="dark" width="25vw;">
                <div style="float: left">
                    <img  v-bind:src='"http://localhost:8000/images/"+(select_item.tale_image_array)'/>

                    <hr>
                    미리보기 사진
                </div>
                <div>
                    <h2>{{select_item.tale_title}}</h2>
                    <hr>
                    추천 부분

                    <vs-button
                            @click="$vs.notify(
                                {title:'추천 되었습니다.',
                                text:'고마워요!!!',
                                color:'danger',
                                icon:'favorite'})"
                            vs-type="danger-filled">추천</vs-button>
                    <h2>{{select_item.tale_price}}</h2>
                    <hr>
                    {{select_item.tale_explain}}
                    <hr>
                    <vs-button vs-type="primary-gradient" @click="alert('success',select_item.fairy_tale_no)">구독</vs-button>
                    <vs-button
                            @click="$vs.notify(
                                {title:'장바구니에 추가asd 되었습니다.',
                                text:'최고에요!',
                                color:'success',
                                icon:'favorite'})
                                like_it(select_item)"
                            vs-type="primary-gradient">장바구니</vs-button>
                </div>
            </sweet-modal>
        </div>
</template>


