<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use App\Social;
use Illuminate\Http\Request;

class SettingController extends MasterController
{
    public function __construct(Setting $model)
    {
        $this->model = $model;
        $this->route = 'setting';
        $this->json_fields        = ["عن التطبيق" => "about","كيفية الاستخدام"=>"how","شروط الاستخدام"=>"terms"];
        $this->module_name         = 'قائمة الاعدادات';
        $this->update_fields        = ['رقم الجوال' => 'mobile','البريد الإلكترونى' => 'email'];
        parent::__construct();

    }

    public function get_setting()
    {
        $row = $this->model->first();
        $facebook=Social::whereName('facebook')->value('link');
        $twitter=Social::whereName('twitter')->value('link');
        $insta=Social::whereName('insta')->value('link');
        return View('admin.setting', compact('row','facebook','insta','twitter'));
    }

    public function update_setting($id, Request $request)
    {
        $setting = $this->model->find($id);
        $data=$request->all();
        $about['ar']=$request['about_ar'];
        $about['en']=$request['about_en'];
        $how['ar']=$request['how_ar'];
        $how['en']=$request['how_en'];
        $terms['ar']=$request['terms_ar'];
        $terms['en']=$request['terms_en'];
        $data['about']=$about;
        $data['how']=$how;
        $data['terms']=$terms;
        $setting->update($data);
        $socials = ['facebook', 'twitter', 'insta'];
        foreach ($socials as $social) {
            $row = Social::where('name', $social)->first();
            $row->link = $request->$social;
            $row->update();
        }
        return redirect('admin/' . $this->route . '')->with('updated', 'تم التعديل بنجاح');
    }
}
