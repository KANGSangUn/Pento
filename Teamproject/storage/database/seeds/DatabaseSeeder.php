<?php

use Illuminate\Database\Seeder;
use Illuminate as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 아두이노
        $this->call('arduinoInfoTableSeeder');
        // 회원
        $this->call('userInfoTableSeeder');
        // 회원 프로필
        $this->call('userProfileTableSeeder');
        // 등록 정보
        $this->call('regiserInfoTableSeeder'); // 오탈자 수정
        // 친구 목록
        $this->call('friendListTableSeeder');

        // 도안 정보
        $this->call('pentoDesignTableSeeder');
        // 좌표 정보
        $this->call('coordinateValueTableSeeder');
        // 단계별 보상
        $this->call('levelRewardTableSeeder');


        // 이미지 루트
        $this->call('imageRouteTableSeeder');
        // 동화 정보
        $this->call('fairyTaleTableSeeder');
        // 이미지 타입
        $this->call('imageTypeTableSeeder');
        // 동화이미지
        $this->call('taleImageTableSeeder');

        // 구매리스트
        $this->call('buyListTableSeeder');
        // 컬렉션테이블
        $this->call('collectionTableSeeder');
        // 기록테이블
        $this->call('pentoRecordTableSeeder');
        // 작품테이블
        $this->call('imitatedPentoTableSeeder');
        // 추천테이블
        $this->call('recommendTableSeeder');
    }
}
