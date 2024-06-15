<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;
use App\Model\Setting;

class WebPageController extends Controller
{
    public function headerMenu(){
		
		// $get Header Menu 
		$h_menu = Menus::where('id', 1)->with('items')->first();

		$header_menu = $h_menu->items->toArray();

		return $header_menu;
	}

	public function footerMenu(){
		
		// $get footer Menu 
		$h_menu = Menus::where('id', 2)->with('items')->first();

		$footer_menu = $h_menu->items->toArray();

		return $footer_menu;
	}

	public function web(){
		
        $web = Setting::select('value')->where(['key'=> 'web_setting'])->first();
        $data = json_decode($web->value);

		return $data;
	}
}
