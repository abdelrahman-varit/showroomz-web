<?php

namespace Showroomz\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('channels')->delete();

        DB::table('locales')->delete();

        DB::table('locales')->insert([
            'id' => 1,
            'code' => 'en',
            'name' => 'English',
            'direction' => 'ltr',
        ]);

        DB::table('locales')->insert([
            'id' => 2,
            'code' => 'ar',
            'name' => 'Arabic',
            'direction' => 'rtl',
        ]);
    }
}