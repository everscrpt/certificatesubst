<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private $post_type = 'page';

    public function index(Request $request)
    {

        $slug = $request->slug;
        $data = Post::with('media')->where(['post_type' => $this->post_type, 'post_status' => 'published', 'slug' => $slug])->first();

        if ($data) {
            $pageTitle = $data->post_title.' - '.env('APP_NAME');
            $page_desc = $data->post_description;
            $page = ucwords($data->post_title);
            $activePage = $data->post_title;

            $post_id = $data->id;

            return view('web.page-layout', compact('pageTitle', 'page_desc', 'page', 'activePage', 'data', 'post_id'));
        } else {
            return abort(404);
        }

    }
}
