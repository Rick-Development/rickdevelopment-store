<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExtensionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $extensions = [
            [
                'id' => 2,
                'name' => 'Google Analytics 4',
                'alias' => 'google_analytics',
                'logo' => 'images/extensions/google-analytics.png',
                'settings' => json_encode([
                    'measurement_id' => 'G-KPWJX44213'
                ]),
                'instructions' => '<ul class="mb-0"> 
<li>Enter google analytics 4 measurement ID, like <strong>G-12345ABC</strong></li> 
</ul>',
                'status' => 1,
                'created_at' => '2022-02-23 19:40:12',
                'updated_at' => '2025-10-11 01:39:37',
            ],
            [
                'id' => 3,
                'name' => 'Tawk.to',
                'alias' => 'tawk_to',
                'logo' => 'images/extensions/tawk-to.png',
                'settings' => json_encode([
                    'api_key' => null
                ]),
                'instructions' => '<ul class="mb-0"> 
<li>https://tawk.to/chat/<strong>API-KEY</strong></li> 
</ul>',
                'status' => 0,
                'created_at' => '2022-02-23 19:40:12',
                'updated_at' => '2023-08-02 15:33:08',
            ],
            [
                'id' => 4,
                'name' => 'Imgur',
                'alias' => 'imgur',
                'logo' => 'images/extensions/imgur.png',
                'settings' => json_encode([
                    'client_id' => null
                ]),
                'instructions' => '<ul class="mb-0"> 
<li class="mb-2">Imgur API used to upload images from editors all over the website, this is required for the upload function to work.</li>
<li>Get your client id from:
<a href="https://api.imgur.com/oauth2/addclient" target="_blank">https://api.imgur.com/oauth2/addclient</a>
</li> 
</ul>',
                'status' => 0,
                'created_at' => '2022-02-23 19:40:12',
                'updated_at' => '2024-09-30 17:26:23',
            ],
            [
                'id' => 5,
                'name' => 'Trustip',
                'alias' => 'trustip',
                'logo' => 'images/extensions/trustip.png',
                'settings' => json_encode([
                    'api_key' => null
                ]),
                'instructions' => '<ul class="mb-0"> 
<li class="mb-2">Trustip is used to block people who uses VPN, Proxy, etc from registering or purchasing from the marketplace.</li>
<li>Get your api key from:
<a href="https://trustip.io" target="_blank">https://trustip.io</a>
</li> 
</ul>',
                'status' => 0,
                'created_at' => '2022-02-23 19:40:12',
                'updated_at' => '2024-06-14 13:34:40',
            ],
        ];

        DB::table('extensions')->insert($extensions);
    }
}
