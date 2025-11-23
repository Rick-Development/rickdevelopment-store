<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingsSeeder::class);
         $this->call(ExtensionsSeeder::class);
          $this->call(AdminUserSeeder::class);
          $this->call(ThemesSeeder::class);
    }
}
