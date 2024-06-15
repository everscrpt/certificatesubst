<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;

class MenuController extends Controller
{
    public function index(){
		return view('admin.menu.index');
	}
}
