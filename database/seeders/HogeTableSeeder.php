<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ←これを追加

class HogeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DBファサードを使用してデータ追加
        DB::table('hoge')->insert([
            
                'user_id'       => '1',
                'hoge_name'     => 'hoge',
            ])
    }
}

