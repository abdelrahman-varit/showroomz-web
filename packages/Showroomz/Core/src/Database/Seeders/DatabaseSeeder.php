<?php

namespace Showroomz\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Core\Database\Seeders\ConfigTableSeeder;
use Webkul\Core\Database\Seeders\CountriesTableSeeder;
use Webkul\Core\Database\Seeders\CountryStateTranslationSeeder;
use Webkul\Core\Database\Seeders\StatesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LocalesTableSeeder::class);
        $this->call(CurrencyTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(CountryStateTranslationSeeder::class);
        $this->call(ChannelTableSeeder::class);
        $this->call(ConfigTableSeeder::class);
    }
}
