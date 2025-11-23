<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'id' => 1,
                'key' => 'general',
                'value' => json_encode([
                    'site_name' => 'zerion',
                    'site_url' => 'https://zerionhq.store/',
                    'date_format' => '10',
                    'timezone' => 'America/New_York',
                    'contact_email' => 'info@zerionhq.com',
                ]),
            ],
            [
                'id' => 2,
                'key' => 'smtp',
                'value' => json_encode([
                    'status' => 1,
                    'mailer' => 'smtp',
                    'host' => 'premium272.web-hosting.com',
                    'port' => '465',
                    'username' => 'support@store.rickdevelopment.com',
                    'password' => 'OU1nN=NjrS%R',
                    'encryption' => 'tls',
                    'from_email' => 'support@store.rickdevelopment.com',
                    'from_name' => 'Rick Development',
                ]),
            ],
            [
                'id' => 3,
                'key' => 'actions',
                'value' => json_encode([
                    'registration' => 1,
                    'email_verification' => 1,
                    'gdpr_cookie' => 1,
                    'force_ssl' => 0,
                    'blog' => 1,
                    'tickets' => 1,
                    'refunds' => 0,
                    'contact_page' => 1,
                ]),
            ],
            [
                'id' => 4,
                'key' => 'currency',
                'value' => json_encode([
                    'code' => 'USD',
                    'symbol' => '$',
                    'position' => '1',
                ]),
            ],
            [
                'id' => 5,
                'key' => 'deposit',
                'value' => json_encode([
                    'status' => 1,
                    'minimum' => '10',
                    'maximum' => '100000000',
                ]),
            ],
            [
                'id' => 6,
                'key' => 'seo',
                'value' => json_encode([
                    'title' => 'Shop Elite App Templates & Codebases | Rick Development Store',
                    'description' => 'Elite app templates, source codes, and UI kits built for speed, scalability, and real-world use—trusted by developers and startups',
                    'keywords' => 'app templates, laravel scripts, flutter UI kits, source code store, SaaS boilerplate, mobile app templates, fintech systems, ecommerce templates, Rick Development, full-stack codebase',
                ]),
            ],
            [
                'id' => 7,
                'key' => 'system_admin',
                'value' => json_encode([
                    'colors' => [
                        'primary_color' => '#191c47',
                        'secondary_color' => '#191c47',
                        'background_color' => '#f9fafb',
                        'sidebar_background_color' => '#191c47',
                        'navbar_background_color' => '#ffffff',
                    ],
                ]),
            ],
            [
                'id' => 9,
                'key' => 'kyc',
                'value' => json_encode([
                    'status' => 1,
                    'selfie_verification' => 1,
                    'required' => 0,
                    'id_front_image' => 'images/kyc/F6uxReOavrBbRnr_1708719956.svg',
                    'id_back_image' => 'images/kyc/lDNgqlaFCClbRaA_1708720002.svg',
                    'passport_image' => 'images/kyc/QLEDc8sXn6h2e7E_1708729601.svg',
                    'selfie_image' => 'images/kyc/5CwgvmI9gcd067i_1708720379.svg',
                ]),
            ],
            [
                'id' => 10,
                'key' => 'item',
                'value' => json_encode([
                    'buy_now_button' => 1,
                    'item_total_sales' => 1,
                    'free_item_total_downloads' => 1,
                    'reviews_status' => 1,
                    'comments_status' => 1,
                    'support_status' => 1,
                    'changelogs_status' => 1,
                    'free_items_require_login' => 1,
                    'trending_number' => '20',
                    'best_selling_number' => '20',
                    'convert_images_webp' => '1',
                    'file_duration' => '24',
                ]),
            ],
            [
                'id' => 13,
                'key' => 'language',
                'value' => json_encode([
                    'code' => 'en',
                    'direction' => 'ltr',
                ]),
            ],
            [
                'id' => 14,
                'key' => 'links',
                'value' => json_encode([
                    'terms_of_use_link' => '/terms-of-use',
                    'licenses_terms_link' => '/licenses-terms',
                    'free_items_policy' => '/free-items-policy',
                ]),
            ],
            [
                'id' => 15,
                'key' => 'announcement',
                'value' => json_encode([
                    'body' => '20% Off  for christmas promo',
                    'button_title' => 'Get It Now >>',
                    'button_link' => '/',
                    'background_color' => '#191c47',
                    'button_background_color' => '#ffffff',
                    'button_text_color' => '#191c47',
                    'status' => 1,
                ]),
            ],
            [
                'id' => 17,
                'key' => 'cronjob',
                'value' => json_encode([
                    'key' => 'YqaQAl878Lan',
                    'last_execution' => '2025-10-29T00:05:09.749976Z',
                ]),
            ],
            [
                'id' => 18,
                'key' => 'ticket',
                'value' => json_encode([
                    'file_types' => 'jpeg,jpg,png,pdf',
                    'max_files' => '5',
                    'max_file_size' => '10',
                ]),
            ],
            [
                'id' => 19,
                'key' => 'maintenance',
                'value' => json_encode([
                    'status' => 0,
                    'title' => 'Under Maintenance',
                    'body' => 'Our site is currently undergoing scheduled maintenance to enhance your browsing experience. We apologize for any inconvenience and appreciate your patience. Please check back soon!',
                    'password' => '',
                    'image' => 'images/maintenance/rrKIohOTdb7fyo5_1727390834.jpg',
                ]),
            ],
            [
                'id' => 21,
                'key' => 'social_links',
                'value' => json_encode([
                    'facebook' => '/',
                    'x' => '/',
                    'youtube' => '/',
                    'linkedin' => '/',
                    'instagram' => '/',
                    'pinterest' => '/',
                ]),
            ],
            [
                'id' => 24,
                'key' => 'premium',
                'value' => json_encode([
                    'status' => 1,
                    'terms_link' => '/premium-terms',
                ]),
            ],
            [
                'id' => 25,
                'key' => 'newsletter',
                'value' => json_encode([
                    'status' => 1,
                    'popup_status' => 0,
                    'footer_status' => 1,
                    'register_new_users' => 1,
                    'popup_image' => 'images/newsletter/ZJFfOW69evqne8n_1757639339.jpg',
                    'popup_reminder_time' => '24',
                ]),
            ],
            [
                'id' => 26,
                'key' => 'api',
                'value' => json_encode([
                    'status' => 1,
                    'key' => 'QSqGSlFhMKdK8oq1d7QcCbYTDhDz9FIGCUWMNjuUfEvu9cNSJU',
                ]),
            ],
        ];

        DB::table('settings')->insert($settings);
    }
}
