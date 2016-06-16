<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'is_saler' => 0,
            'level' => 5,
            'name' => '马云',
            'telephone' => '110',
            'address' => 'Beijing',
            'zipcode' => '210093',
            'email' => str_random(10, 15) + '@gmail.com',
            'should_receive_quota' => 2000,
            'should_receive' => 0,
            'should_pay' => 0,
            'created_at' => '2015-12-12',
            'updated_at' => '2015-12-12'
        ]);

        DB::table('customers')->insert([
            'is_saler' => 0,
            'level' => 3,
            'name' => '李开复',
            'telephone' => '110',
            'address' => 'Beijing',
            'zipcode' => '210093',
            'email' => str_random(10, 15) + '@gmail.com',
            'should_receive_quota' => 2000,
            'should_receive' => 0,
            'should_pay' => 0,
            'created_at' => '2015-12-12',
            'updated_at' => '2015-12-12'
        ]);

        DB::table('customers')->insert([
            'is_saler' => 0,
            'level' => 3,
            'name' => '创新工场',
            'telephone' => '110',
            'address' => 'Beijing',
            'zipcode' => '210093',
            'email' => str_random(10, 15) + '@gmail.com',
            'should_receive_quota' => 2000,
            'should_receive' => 0,
            'should_pay' => 0,
            'created_at' => '2015-12-12',
            'updated_at' => '2015-12-12'
        ]);

        DB::table('customers')->insert([
            'is_saler' => 0,
            'level' => 0,
            'name' => '小工厂',
            'telephone' => '110',
            'address' => 'Beijing',
            'zipcode' => '210093',
            'email' => str_random(10, 15) + '@gmail.com',
            'should_receive_quota' => 2000,
            'should_receive' => 0,
            'should_pay' => 0,
            'created_at' => '2015-12-12',
            'updated_at' => '2015-12-12'
        ]);

        DB::table('customers')->insert([
            'is_saler' => 1,
            'level' => 3,
            'name' => '金润发',
            'telephone' => '110',
            'address' => 'Beijing',
            'zipcode' => '210093',
            'email' => str_random(10, 15) + '@gmail.com',
            'should_receive_quota' => 2000,
            'should_receive' => 0,
            'should_pay' => 0,
            'created_at' => '2015-12-12',
            'updated_at' => '2015-12-12'
        ]);

        DB::table('customers')->insert([
            'is_saler' => 1,
            'level' => 3,
            'name' => '华莲吉买盛',
            'telephone' => '110',
            'address' => 'Beijing',
            'zipcode' => '210093',
            'email' => str_random(10, 15) + '@gmail.com',
            'should_receive_quota' => 2000,
            'should_receive' => 0,
            'should_pay' => 0,
            'created_at' => '2015-12-12',
            'updated_at' => '2015-12-12'
        ]);

        DB::table('customers')->insert([
            'is_saler' => 1,
            'level' => 5,
            'name' => '金鹰',
            'telephone' => '110',
            'address' => 'Beijing',
            'zipcode' => '210093',
            'email' => str_random(10, 15) + '@gmail.com',
            'should_receive_quota' => 2000,
            'should_receive' => 0,
            'should_pay' => 0,
            'created_at' => '2015-12-12',
            'updated_at' => '2015-12-12'
        ]);

        DB::table('customers')->insert([
            'is_saler' => 1,
            'level' => 1,
            'name' => '小卖部',
            'telephone' => '110',
            'address' => 'Beijing',
            'zipcode' => '210093',
            'email' => str_random(10, 15) + '@gmail.com',
            'should_receive_quota' => 2000,
            'should_receive' => 0,
            'should_pay' => 0,
            'created_at' => '2015-12-12',
            'updated_at' => '2015-12-12'
        ]);

    }
}
