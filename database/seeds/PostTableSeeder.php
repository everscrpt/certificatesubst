<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_html = '<h2>Where does it come from?</h2>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there is not anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. </p> <br><br>
                    <h5>Why do we use it?</h5>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using, making it look like readable English.</p> <br>
                    <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for  will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose.</p>
                    ';
        $meta_description = 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy.';

        DB::table('posts')->insert([[
            'post_author' => '1',
            'post_content' => $data_html,
            'post_title' => 'Page One',
            'meta_description' => $meta_description,
            'slug' => 'page-one',
            'post_excerpt' => 'page-one',
            'post_status' => 'published',
            'post_type' => 'page',
            'created_at' => now(),
        ],
            [
                'post_author' => '1',
                'post_content' => $data_html,
                'post_title' => 'Page Two',
                'meta_description' => $meta_description,
                'slug' => 'page-two',
                'post_excerpt' => 'page-two',
                'post_status' => 'published',
                'post_type' => 'page',
                'created_at' => now(),
            ],
        ]);
    }
}
