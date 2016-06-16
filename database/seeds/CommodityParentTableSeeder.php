<?php

use Illuminate\Database\Seeder;

class CommodityParentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('commodity_parents')->insert([
            'name' => '空调',
            'is_deleted' => 0,
            'created_at' => '2015-10-01',
            'updated_at' => '2016-01-01'
        ]);

        DB::table('commodity_parents')->insert([
            'name' => '冰箱',
            'is_deleted' => 0,
            'created_at' => '2015-10-01',
            'updated_at' => '2016-01-01'
        ]);

        DB::table('commodity_parents')->insert([
            'name' => '薯片',
            'is_deleted' => 0,
            'created_at' => '2015-10-01',
            'updated_at' => '2016-01-01'
        ]);

    }
}
