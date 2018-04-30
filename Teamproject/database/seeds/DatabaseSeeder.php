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
        $this->call('ArduinoInfoTableSeeder');
        // 색상 정보
        $this->call('ColorInfoTableSeeder');
        // 이미지 루트
        $this->call('ImageRouteTableSeeder');

        // 회원 정보
        $this->call('UserInfoTableSeeder');
        // 회원 프로필
        $this->call('UserProfileTableSeeder');
        // 팔로우 목록
        $this->call('FollowListTableSeeder');

        // 도안 정보
        $this->call('PentoDesignTableSeeder');


        // 컬렉션테이블
        $this->call('CollectionTableSeeder');

        // 작품테이블
        $this->call('ImitatedPentoTableSeeder');
        // 추천테이블
        $this->call('RecommendTableSeeder');
        
        // 동화 정보
        $this->call('FairyTaleTableSeeder');
        // 동화이미지
        $this->call('TaleImageTableSeeder');
        // 동화 도안
        $this->call('TaleDesignTableSeeder');
        // 구매리스트
        $this->call('BuyListTableSeeder');


    }
}
