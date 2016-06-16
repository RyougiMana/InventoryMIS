<?php

use Illuminate\Database\Seeder;

class CommodityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('commodities')->insert([
            'name' => '变频大1.5P冷暖空调',
            'parent_id' => 1,
            'classification' => '格力',
            'count' => random_int(300, 300),
            'purchase_price' => 2000,
            'retail_price' => 2999,
            'recent_purchase_price' => 2000,
            'recent_retail_price' => 2999,
            'is_deleted' => 0,
            'created_at' => '2016-05-01',
            'updated_at' => '2016-05-01'
        ]);

        DB::table('commodities')->insert([
            'name' => '变频大2匹立式冷暖空调',
            'parent_id' => 1,
            'classification' => '格力',
            'count' => random_int(100, 120),
            'purchase_price' => 3500,
            'retail_price' => 4999,
            'recent_purchase_price' => 3500,
            'recent_retail_price' => 4999,
            'is_deleted' => 0,
            'created_at' => '2016-05-01',
            'updated_at' => '2016-05-01'
        ]);

        DB::table('commodities')->insert([
            'name' => 'FNhDa-A3大1.5匹除甲醛变频空调',
            'parent_id' => 1,
            'classification' => '格力',
            'count' => random_int(2500, 2700),
            'purchase_price' => 1800,
            'retail_price' => 2999,
            'recent_purchase_price' => 1800,
            'recent_retail_price' => 2999,
            'is_deleted' => 0,
            'created_at' => '2016-05-01',
            'updated_at' => '2016-05-01'
        ]);

        DB::table('commodities')->insert([
            'name' => '3匹高端柜机定速空调',
            'parent_id' => 1,
            'classification' => '格力',
            'count' => random_int(100, 200),
            'purchase_price' => 4000,
            'retail_price' => 6199,
            'recent_purchase_price' => 4000,
            'recent_retail_price' => 6199,
            'is_deleted' => 0,
            'created_at' => '2016-05-01',
            'updated_at' => '2016-05-01'
        ]);

        /**/

        DB::table('commodities')->insert([
            'name' => '大2匹远送风双重滤网家用冷暖空调柜机',
            'parent_id' => 1,
            'classification' => '美的',
            'count' => random_int(250, 260),
            'purchase_price' => 2400,
            'retail_price' => 3999,
            'recent_purchase_price' => 2400,
            'recent_retail_price' => 3999,
            'is_deleted' => 0,
            'created_at' => '2016-06-01',
            'updated_at' => '2016-06-01'
        ]);

        DB::table('commodities')->insert([
            'name' => '大1.5匹智能云控变频家用空调挂机',
            'parent_id' => 1,
            'classification' => '美的',
            'count' => random_int(100, 500),
            'purchase_price' => 3000,
            'retail_price' => 3399,
            'recent_purchase_price' => 3000,
            'recent_retail_price' => 3399,
            'is_deleted' => 0,
            'created_at' => '2016-06-01',
            'updated_at' => '2016-06-01'
        ]);

        DB::table('commodities')->insert([
            'name' => '3匹节能智能冷暖变频圆形空调柜机',
            'parent_id' => 1,
            'classification' => '美的',
            'count' => random_int(130, 140),
            'purchase_price' => 5000,
            'retail_price' => 7499,
            'recent_purchase_price' => 5000,
            'recent_retail_price' => 7499,
            'is_deleted' => 0,
            'created_at' => '2016-06-01',
            'updated_at' => '2016-06-01'
        ]);

        /**/

        DB::table('commodities')->insert([
            'name' => '19UAAAL23AU1大1.5变频智能空调挂机',
            'parent_id' => 1,
            'classification' => '海尔',
            'count' => random_int(330, 4000),
            'purchase_price' => 2400,
            'retail_price' => 2899,
            'recent_purchase_price' => 2400,
            'recent_retail_price' => 2899,
            'is_deleted' => 0,
            'created_at' => '2016-06-05',
            'updated_at' => '2016-06-05'
        ]);

        DB::table('commodities')->insert([
            'name' => '大2匹立式柜式空调柜机大',
            'parent_id' => 1,
            'classification' => '海尔',
            'count' => random_int(30, 40),
            'purchase_price' => 4000,
            'retail_price' => 6099,
            'recent_purchase_price' => 4000,
            'recent_retail_price' => 6099,
            'is_deleted' => 0,
            'created_at' => '2016-06-05',
            'updated_at' => '2016-06-05'
        ]);

        DB::table('commodities')->insert([
            'name' => '大2匹智能除甲醛柜机二级能效',
            'parent_id' => 1,
            'classification' => '海尔',
            'count' => random_int(30, 40),
            'purchase_price' => 4100,
            'retail_price' => 5399,
            'recent_purchase_price' => 4100,
            'recent_retail_price' => 5399,
            'is_deleted' => 0,
            'created_at' => '2016-06-05',
            'updated_at' => '2016-06-05'
        ]);

        /**/

        DB::table('commodities')->insert([
            'name' => '冰箱1',
            'parent_id' => 2,
            'classification' => '松下',
            'count' => random_int(100, 400),
            'purchase_price' => random_int(1599, 2999),
            'retail_price' => random_int(3000, 5999),
            'recent_purchase_price' => 0,
            'recent_retail_price' => 0,
            'is_deleted' => 0,
            'created_at' => '2016-06-12',
            'updated_at' => '2016-06-12'
        ]);

        DB::table('commodities')->insert([
            'name' => '冰箱2',
            'parent_id' => 2,
            'classification' => '松下',
            'count' => random_int(100, 400),
            'purchase_price' => random_int(1599, 2999),
            'retail_price' => random_int(3000, 5999),
            'recent_purchase_price' => 0,
            'recent_retail_price' => 0,
            'is_deleted' => 0,
            'created_at' => '2016-06-12',
            'updated_at' => '2016-06-12'
        ]);

        DB::table('commodities')->insert([
            'name' => '冰箱3',
            'parent_id' => 2,
            'classification' => '松下',
            'count' => random_int(100, 400),
            'purchase_price' => random_int(1599, 2999),
            'retail_price' => random_int(3000, 5999),
            'recent_purchase_price' => 0,
            'recent_retail_price' => 0,
            'is_deleted' => 0,
            'created_at' => '2016-06-12',
            'updated_at' => '2016-06-12'
        ]);

        DB::table('commodities')->insert([
            'name' => '冰箱4',
            'parent_id' => 2,
            'classification' => '松下',
            'count' => random_int(100, 400),
            'purchase_price' => random_int(1599, 2999),
            'retail_price' => random_int(3000, 5999),
            'recent_purchase_price' => 0,
            'recent_retail_price' => 0,
            'is_deleted' => 0,
            'created_at' => '2016-06-12',
            'updated_at' => '2016-06-12'
        ]);

        DB::table('commodities')->insert([
            'name' => '冰箱5',
            'parent_id' => 2,
            'classification' => '松下',
            'count' => random_int(100, 400),
            'purchase_price' => random_int(1599, 2999),
            'retail_price' => random_int(3000, 5999),
            'recent_purchase_price' => 0,
            'recent_retail_price' => 0,
            'is_deleted' => 0,
            'created_at' => '2016-06-12',
            'updated_at' => '2016-06-12'
        ]);

        /**/

        DB::table('commodities')->insert([
            'name' => '冰箱6',
            'parent_id' => 2,
            'classification' => '海信',
            'count' => random_int(100, 400),
            'purchase_price' => random_int(1599, 2999),
            'retail_price' => random_int(3000, 5999),
            'recent_purchase_price' => 0,
            'recent_retail_price' => 0,
            'is_deleted' => 0,
            'created_at' => '2016-06-12',
            'updated_at' => '2016-06-12'
        ]);

        DB::table('commodities')->insert([
            'name' => '冰箱7',
            'parent_id' => 2,
            'classification' => '海信',
            'count' => random_int(100, 400),
            'purchase_price' => random_int(1599, 2999),
            'retail_price' => random_int(3000, 5999),
            'recent_purchase_price' => 0,
            'recent_retail_price' => 0,
            'is_deleted' => 0,
            'created_at' => '2016-06-12',
            'updated_at' => '2016-06-12'
        ]);

        DB::table('commodities')->insert([
            'name' => '冰箱8',
            'parent_id' => 2,
            'classification' => '海信',
            'count' => random_int(100, 400),
            'purchase_price' => random_int(1599, 2999),
            'retail_price' => random_int(3000, 5999),
            'recent_purchase_price' => 0,
            'recent_retail_price' => 0,
            'is_deleted' => 0,
            'created_at' => '2016-06-12',
            'updated_at' => '2016-06-12'
        ]);

        DB::table('commodities')->insert([
            'name' => '冰箱9',
            'parent_id' => 2,
            'classification' => '海信',
            'count' => random_int(100, 400),
            'purchase_price' => random_int(1599, 2999),
            'retail_price' => random_int(3000, 5999),
            'recent_purchase_price' => 0,
            'recent_retail_price' => 0,
            'is_deleted' => 0,
            'created_at' => '2016-06-12',
            'updated_at' => '2016-06-12'
        ]);

        /**/

        DB::table('commodities')->insert([
            'name' => '黄瓜味(小)',
            'parent_id' => 3,
            'classification' => '乐事',
            'count' => random_int(500, 700),
            'purchase_price' => 2,
            'retail_price' => 3.5,
            'recent_purchase_price' => 2,
            'recent_retail_price' => 3.5,
            'is_deleted' => 0,
            'created_at' => '2016-06-14',
            'updated_at' => '2016-06-14'
        ]);

        DB::table('commodities')->insert([
            'name' => '黄瓜味(大)',
            'parent_id' => 3,
            'classification' => '乐事',
            'count' => random_int(1500, 1700),
            'purchase_price' => 4,
            'retail_price' => 6,
            'recent_purchase_price' => 4,
            'recent_retail_price' => 6,
            'is_deleted' => 0,
            'created_at' => '2016-06-14',
            'updated_at' => '2016-06-14'
        ]);

        DB::table('commodities')->insert([
            'name' => '原味(小)',
            'parent_id' => 3,
            'classification' => '乐事',
            'count' => random_int(500, 700),
            'purchase_price' => 2.5,
            'retail_price' => 3.5,
            'recent_purchase_price' => 2,
            'recent_retail_price' => 3.5,
            'is_deleted' => 0,
            'created_at' => '2016-06-14',
            'updated_at' => '2016-06-14'
        ]);

        DB::table('commodities')->insert([
            'name' => '原味(大)',
            'parent_id' => 3,
            'classification' => '乐事',
            'count' => random_int(1500, 1700),
            'purchase_price' => 4,
            'retail_price' => 6,
            'recent_purchase_price' => 4,
            'recent_retail_price' => 6,
            'is_deleted' => 0,
            'created_at' => '2016-06-14',
            'updated_at' => '2016-06-14'
        ]);

        /**/

        DB::table('commodities')->insert([
            'name' => '柠檬味(小)',
            'parent_id' => 3,
            'classification' => '上好佳',
            'count' => random_int(100, 300),
            'purchase_price' => 1.2,
            'retail_price' => 3.5,
            'recent_purchase_price' => 1.2,
            'recent_retail_price' => 3.5,
            'is_deleted' => 0,
            'created_at' => '2016-06-14',
            'updated_at' => '2016-06-14'
        ]);

        DB::table('commodities')->insert([
            'name' => '柠檬味(大)',
            'parent_id' => 3,
            'classification' => '上好佳',
            'count' => random_int(300, 400),
            'purchase_price' => 4,
            'retail_price' => 5.5,
            'recent_purchase_price' => 4,
            'recent_retail_price' => 5.5,
            'is_deleted' => 0,
            'created_at' => '2016-06-14',
            'updated_at' => '2016-06-14'
        ]);

    }
}
