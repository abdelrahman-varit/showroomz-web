<?php

namespace Showroomz\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencyTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('channels')->delete();

        DB::table('currencies')->delete();

        DB::table('currencies')->insert([
            'id' => 1,
            'code' => 'EGP',
            'name' => 'Egyptian Pound',
            'symbol' => 'ج.م.'
        ]);

        DB::table('currencies')->insert([
            'id' => 2,
            'code' => 'USD',
            'name' => 'US Dollar',
            'symbol' => '$'
        ]);
    }
}