<?php

namespace Showroomz\User\Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->delete();

        DB::table('admins')->insert([
            'id' => 1,
            'name' => 'Showroomz',
            'email' => 'admin@showroomz.co',
            'password' => bcrypt("SR'llb3gr8"),
            'api_token' => Str::random(80),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => 1,
            'role_id' => 1,
        ]);
    }
}
