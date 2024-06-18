<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function home_setting()
    {

        $settings = Setting::select('value')->where(['key' => 'home_setting'])->first();

        $data = json_decode($settings->value);

        return view('admin.setting.home-page', compact('data'));
    }

    public function home_setting_update(Request $request)
    {

        $data = json_encode($request->all());

        Setting::where(['key' => 'home_setting'])->update(['value' => $data]);

        return back()->withSuccess('Setting updated successfully...');
    }

    public function search_setting()
    {

        $settings = Setting::select('value')->where(['key' => 'search_setting'])->first();

        $data = json_decode($settings->value);

        // dd($data);

        return view('admin.setting.search-page', compact('data'));
    }

    public function search_setting_update(Request $request)
    {

        $data = json_encode($request->all());

        Setting::where(['key' => 'search_setting'])->update(['value' => $data]);

        return back()->withSuccess('Setting updated successfully...');
    }

    public function home_ocn_update(Request $request)
    {

        // Old Data
        $home_data = Setting::select('value')->where(['key' => 'home_ocn'])->first();
        $home_ocn = json_decode($home_data->value);

        if ($request->hasFile('image')) {

            $file_name_without_extension = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);

            if ($request->hasFile('image')) {
                $extension = $request->image->getClientOriginalExtension();
                $file_name = $file_name_without_extension.'.'.$extension;
                $path = $request->image->storeAs('ocn', $file_name, 'public');
                $file_path = '/storage/ocn/'.$file_name;
            } else {
                $file_path = null;
            }

            $data = $request->all();
            unset($data['_token']);
            unset($data['_method']);
            unset($data['fileType']);
            unset($data['contentType']);
            $data['image'] = $file_path;
        } else {
            $data = $request->all();
            $data['image'] = $home_ocn->image;
            $file_name_without_extension = '';
        }

        $ocn_data = json_encode($data);

        Setting::where(['key' => 'home_ocn'])->update(['value' => $ocn_data]);

        return back()->withSuccess('Home OCN updated successfully...');
    }

    public function search_ocn_update(Request $request)
    {

        // Old Data
        $search_data = Setting::select('value')->where(['key' => 'search_ocn'])->first();
        $search_ocn = json_decode($search_data->value);

        if ($request->hasFile('image')) {

            $file_name_without_extension = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);

            if ($request->hasFile('image')) {
                $extension = $request->image->getClientOriginalExtension();
                $file_name = $file_name_without_extension.'.'.$extension;
                $path = $request->image->storeAs('ocn', $file_name, 'public');
                $file_path = '/storage/ocn/'.$file_name;
            } else {
                $file_path = null;
            }

            $data = $request->all();
            unset($data['_token']);
            unset($data['_method']);
            unset($data['fileType']);
            unset($data['contentType']);
            $data['image'] = $file_path;
        } else {
            $data = $request->all();
            $data['image'] = $search_ocn->image;
            $file_name_without_extension = '';
        }

        $ocn_data = json_encode($data);

        Setting::where(['key' => 'search_ocn'])->update(['value' => $ocn_data]);

        return back()->withSuccess('Search OCN updated successfully...');
    }

    public function web_setting()
    {

        $settings = Setting::select('value')->where(['key' => 'web_setting'])->first();

        $data = json_decode($settings->value);

        // dd($data);

        return view('admin.setting.web', compact('data'));
    }

    public function web_setting_update(Request $request)
    {

        $data = json_encode($request->all());

        Setting::where(['key' => 'web_setting'])->update(['value' => $data]);

        return back()->withSuccess('Setting updated successfully...');
    }

    public function mailwizzSetting()
    {

        $settings = Setting::select('value')->where(['key' => 'mailwizz_setting'])->first();

        $data = json_decode($settings->value);

        return view('admin.setting.mailwizz-setting', compact('data'));
    }

    public function mailwizzSettingUpdate(Request $request)
    {

        if ($request['status'] == 'on') {
            $request['status'] = 1;
        } else {
            $request['status'] = 0;
        }

        $data = json_encode($request->all());

        Setting::where(['key' => 'mailwizz_setting'])->update(['value' => $data]);

        return back()->withSuccess('Setting updated successfully...');
    }
}
