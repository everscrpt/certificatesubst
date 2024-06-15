<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Model\Post;
use App\Model\Setting;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get Pages 
        // $pages = Post::with('media')->where(['post_type'=>'page','post_status'=>'published'])->get();

        // OCN 

        $home_data = Setting::select('value')->where(['key'=> 'home_ocn'])->first();

        $home_ocn = json_decode($home_data->value);

        $search_data = Setting::select('value')->where(['key'=> 'search_ocn'])->first();

        $search_ocn = json_decode($search_data->value);

        return view('admin.dashboard',compact('home_ocn','search_ocn'));
    }
}
