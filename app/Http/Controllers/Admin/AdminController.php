<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends MasterController
{
    public function __construct(Admin $model)
    {
        $this->model = $model;
        $this->route = 'admin';
        $this->module_name = 'قائمة الادارة';
        $this->single_module_name = 'مدير';
        $this->index_fields = ['الاسم' => 'name', 'البريد الإلكترونى' => 'email', 'رقم الجوال' => 'mobile'];
        $this->create_fields = ['الاسم' => 'name', 'البريد الإلكترونى' => 'email', 'رقم الجوال' => 'mobile'];
        $this->update_fields = ['الاسم' => 'name', 'البريد الإلكترونى' => 'email', 'رقم الجوال' => 'mobile'];
        parent::__construct();
    }
    public function validation_func($method, $id = null)
    {
        if ($method == 1)
            return ['name' => 'required', 'mobile' => 'required|unique:admins', 'email' => 'email|max:255|unique:admins', 'image' => 'mimes:png,jpg,jpeg', 'password' => 'required|min:6'];
        return ['name' => 'required', 'mobile' => 'required|unique:admins,mobile,' . $id, 'email' => 'email|max:255|unique:admins,email,' . $id, 'image' => 'mimes:png,jpg,jpeg'];
    }
    public function dashboard()
    {
        return view($this->route . '.index');
    }
    public function edit($id=null)
    {
        $row = Auth::user();
        return View($this->route . '.profile', compact('row'));
    }
    public function update($id, Request $request)
    {
        $this->validate($request, $this->validation_func(2, $id));
        $this->model->find($id)->update($request->all());
        return redirect($this->route . '')->with('updated', 'تم التعديل بنجاح');
    }
}
