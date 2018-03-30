export default {
    data(){
        return{
            story :       [], //이야기 리스트 데이터 값을 담는 변수
            select_item : [], //선택한 이야기의 정보를 담는 변수
            basket_item : [], //장바구니 데이터
            backgroundLoading:"#54dc91",
            temp :''
         }
        },
    mounted(){
        //this.page_loading();
        this.storylists(); //선언된 함수를 실행
    },
    methods : {
        page_loading : function () { //페이지 로딩
            this.$vs.loading({background:this.backgroundLoading,color:'rgb(255, 255, 255)'});
            setTimeout( ()=> {
                this.$vs.loading.close()
            }, 1000);
        },
        storylists : function () { //함수선언
            let uri = 'conrouter';
            let art = {
                'kinds' : 'Page',
                'page_name' : 'StoryList',
        };
            this.axios.post(uri,art).then( //서버로 http통신 요청
                (response) => { //response 받은 값 이야기 정보 함수에 전송
                    this.story = response.data;
                });
        },


        alert : function(color,story_number){ //구독하기 버튼
            let uri = 'buystory';
            let art = {
                'kinds' : 'Contents',
                'method_id' : 'Buy',
                'category' : 'tale',
                'contents_id' : story_number
            };
            this.axios.post(uri,art).then(
                (response)=>{
                    this.temp= response.data;
                }
            );
            this.$vs.alert({
                title:'구독 완료!',
                text:this.select_item.title + '를 구독하셨습니다!',
                textConfirm : '확인',
                color:color,

            })
        },
        openStory : function (items) {//동화 클릭시 동화 모달 이벤트 출력
            this.select_item=items;
            this.$refs.modal.open();
        },
        openBasket : function () {
            this.$refs.bkt_modal.open();
        },
        like_it : function (items) { //장바구니 넣기 함수
            this.basket_item.push(items);
        },
        hit_it : function () { //추천 함수
            //서버로 데이터 전송
        },
        delect_Item : function (this_items) {
            //삭제할 동화목록을 없에는 함수
            const deleteItem = this.basket_item.findIndex(function(item)
            {return item.id === this_items.id});
            if (deleteItem > -1) this.basket_item.splice(deleteItem, 1)


        },
    },

};
