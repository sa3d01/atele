<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

class UserController extends MasterController
{
    public function __construct(User $model)
    {
        $this->model = $model;
        $this->route = 'user';
        $this->module_name = 'قائمة الأعضاء';
        $this->single_module_name = 'عضو';
        $this->index_fields = ['الاسم ' => 'name', 'رقم الجوال' => 'mobile', 'البريد الالكترونى' => 'email'];
        $this->create_fields = ['الاسم ' => 'name'];
        $this->update_fields = ['الاسم ' => 'name', 'رقم الجوال' => 'mobile', 'البريد الالكترونى' => 'email'];
        parent::__construct();
    }
    public function admin_status($id)
    {
        $row = $this->model->find($id);
        if($row->admin_status == 'blocked') {
            $this->model->find($id)->update(['admin_status' => 'approved']);
            return back()->with('notice', 'تم التفعيل بنجاح');
        }else{
            $this->model->find($id)->update(['admin_status' => 'blocked']);
            return back()->with('notice', 'تم الغاء التفعيل بنجاح');
        }
    }
    public function index()
    {
        $rows = $this->model->where(['type'=>'user'])->latest()->get();
        return view('admin.' . $this->route . '.index', compact('rows'));
    }
    public function approved_users()
    {
        $rows = $this->model->where(['type'=>'user','admin_status'=>'approved'])->latest()->get();
        return view('admin.' . $this->route . '.index', compact('rows'));
    }
    public function blocked_users()
    {
        $rows = $this->model->where(['type'=>'user','admin_status'=>'blocked'])->latest()->get();
        return view('admin.' . $this->route . '.index', compact('rows'));
    }

    public function validation_func($method, $id = null)
    {
        if ($method == 1) // POST Case
            return ['name' => 'required', 'mobile' => 'required|unique:users', 'email' => 'email|max:255|unique:users', 'image' => 'mimes:png,jpg,jpeg'];
        return ['name' => 'required', 'mobile' => 'required|unique:users,mobile,' . $id, 'email' => 'email|max:255|unique:users,email,' . $id, 'image' => 'mimes:png,jpg,jpeg'];
    }
    public function validation_msg()
    {
        $messsages = array(
            'name.required' => 'يجب ملئ جميع الحقول',
            'mobile.required' => 'يجب ملئ جميع الحقول',
            'password.required' => 'يجب ملئ جميع الحقول',
            'mobile.unique' => 'هذا الهاتف مسجل بالفعل',
            'email.unique' => 'هذا البريد مسجل بالفعل',
        );
        return $messsages;
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->validation_func(1),$this->validation_msg());
        $all = $request->all();
        $all['admin_status'] = 'approved';
        $this->model->create($all);
        return redirect('admin/' . $this->route . '/approved')->with('created', 'تمت الاضافة بنجاح');
    }


}
