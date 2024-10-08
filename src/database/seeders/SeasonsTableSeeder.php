<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'id' => 1,
            'name' => '春',
        ];
        DB::table('seasons')->insert($param);

        $param = [
            'id' => 2,
            'name' => '夏',
        ];
        DB::table('seasons')->insert($param);

        $param = [
            'id' => 3,
            'name' => '秋',
        ];
        DB::table('seasons')->insert($param);

        $param = [
            'id' => 4,
            'name' => '冬',
        ];
        DB::table('seasons')->insert($param);
    }
}
