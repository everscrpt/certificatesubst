<?php

namespace Database\Seeders;

use App\Model\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $home = [
            'title' => 'Home - Certificates of Substantial Performance (CSP)',
            'meta_description' => 'Resources and tools for the Certificate of Substantial Performance (CSP) in Ontario Search for published CSP listing',
            'section_1' => [
                'title' => 'Certificates of Substantial Performance (CSP)',
                'sub_title' => '<p>Resources and tools for the Certificate of Substantial Performance (CSP) in Ontario <br> Search for published CSP listing</p>',
            ],
            'section_2' => [
                'grid_one' => [
                    'title' => 'An introduction to Certificates of Substantial Performance (CSP)s',
                    'sub_title' => 'Certificates of Substantial Performance (CSP)s',
                    'link' => 'https://www.certificatesubstantialperformance.com/sample-page/',
                    'icon' => 'fa fa-universal-access',
                ],
                'grid_three' => [
                    'title' => 'Download Form 9 under the Ontario Construction Act The key CSP form',
                    'sub_title' => 'Certificates of Substantial Performance (CSP)s',
                    'link' => 'https://www.certificatesubstantialperformance.com/wp-content/uploads/2019/06/form9-rev0418-fil-en-3.doc',
                    'icon' => 'fa fa-sitemap',
                ],
            ],
            'section_3' => [
                'featured' => '<h2>Certificates of Substantial Performance (CSP)</h2>',
            ],
        ];

        $search = [
            'title' => 'Search Results - Certificate Substantial Performance',
            'meta_description' => 'Search Results - Certificate Substantial Performance',
            'section_1' => [
                'title' => 'Certificates of Substantial Performance (CSP)',
                'sub_title' => '<p>Resources and tools for the Certificate of Substantial Performance (CSP) in Ontario <br> Search for published CSP listing</p>',
            ],
        ];

        $home_ocn = [
            'title' => 'OCN-Daily cover',
            'link' => 'https://www.ontarioconstructionnews.com',
            'image' => 'storage/ocn/ocn.jpg',
        ];
        $search_ocn = [
            'link' => 'https://www.ontarioconstructionnews.com',
            'image' => 'storage/ocn/ocn.jpg',
        ];
        $web_setting = [
            'site_title' => 'Certificates of Substantial Performance',
            'site_url' => 'https://www.certificatesubstantialperformance.com/',
            'site_script' => '<script></script>',
            'copyright_text' => '<p>© 2020 Copyright certificatesubstantialperformance.com</p>',
        ];
        $mailwizz_setting = [
            'status' => '1',
            'time' => '11:59:56',
            'from_name' => 'Papai Sarkar',
            'from_email' => 'iampapaisarkar@gmail.com',
            'reply_to' => 'iampapaisarkar@gmail.com',
            'mail_subject' => 'OCN Daily updates',
            'mailwizz_list_id' => 'nf371h4n90175',
            'email_template' => '',
        ];

        $settings = [
            ['key' => 'home_setting', 'value' => json_encode($home)],
            ['key' => 'home_ocn', 'value' => json_encode($home_ocn)],
            ['key' => 'search_ocn', 'value' => json_encode($search_ocn)],
            ['key' => 'web_setting', 'value' => json_encode($web_setting)],
            ['key' => 'search_setting', 'value' => json_encode($search)],
            ['key' => 'mailwizz_setting', 'value' => json_encode($mailwizz_setting)],
        ];

        Setting::insert($settings);
    }
}
