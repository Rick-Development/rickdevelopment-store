<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('themes')->insert([
            [
                'id' => 1,
                'name' => 'Basic',
                'alias' => 'basic',
                'version' => '1.0',
                'preview_image' => 'themes/basic/images/preview.jpg',
                'description' => 'Basic theme offers a sleek and modern design, prioritizing user-friendly navigation and aesthetics.',
                'created_at' => '2023-09-29 22:14:13',
                'updated_at' => '2023-09-29 22:14:17',
            ]
        ]);
    }
}
