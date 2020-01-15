<?php

namespace App\Http\Controllers\Admin;

use App\User;
class UserController extends MasterController
{
    public function __construct(User $model)
    {
        $this->model = $model;
        $this->route = 'user';
        $this->module_name = 'قائمة الأعضاء';
        $this->single_module_name = 'عضو';
        $this->index_fields = ['الاسم ' => 'name', 'رقم الجوال' => 'mobile', 'الصورة الشخصية' => 'image'];
        $this->create_fields = ['الاسم ' => 'name', 'رقم الجوال' => 'mobile', 'الصورة الشخصية' => 'image'];
        $this->update_fields = ['الاسم ' => 'name', 'رقم الجوال' => 'mobile', 'الصورة الشخصية' => 'image'];
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->where('type','user')->latest()->get();
        return view('admin.' . $this->route . '.index', compact('rows'));
    }

    public function validation_func($method, $id = null)
    {
        if ($method == 1) // POST Case
            return ['name' => 'required', 'mobile' => 'required|unique:users', 'email' => 'email|max:255|unique:users', 'image' => 'mimes:png,jpg,jpeg'];
        return ['name' => 'required', 'mobile' => 'required|unique:users,mobile,' . $id, 'email' => 'email|max:255|unique:users,email,' . $id, 'image' => 'mimes:png,jpg,jpeg'];
    }


}
