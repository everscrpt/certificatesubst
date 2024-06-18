<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Setting;

class HomeController extends Controller
{
    public function index()
    {
        // Get Home Page Data
        $settings = Setting::select('value')->where(['key' => 'home_setting'])->first();

        // Get Home Ocn
        $home_data = Setting::select('value')->where(['key' => 'home_ocn'])->first();
        $home_ocn = json_decode($home_data->value);

        $data = json_decode($settings->value);

        $pageTitle = $data->title;
        $page_desc = $data->meta_description;

        return view('web.home', compact('data', 'home_ocn', 'pageTitle', 'page_desc'));
    }
}
