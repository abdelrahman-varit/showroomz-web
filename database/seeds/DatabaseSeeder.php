<?php

use Illuminate\Database\Seeder;
use Webkul\Velocity\Database\Seeders\VelocityMetaDataSeeder;
use Showroomz\Admin\Database\Seeders\DatabaseSeeder as ShowroomzDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ShowroomzDatabaseSeeder::class);
        $this->call(VelocityMetaDataSeeder::class);
    }
}
