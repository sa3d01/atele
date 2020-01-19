<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use App\User;
use Edujugon\PushNotification\PushNotification;
use Illuminate\Http\Request;

class ProviderController extends MasterController
{
    public function __construct(User $model)
    {
        $this->model = $model;
        $this->route = 'provider';
        $this->module_name = 'قائمة دور الأزياء';
        $this->single_module_name = 'دار أزياء';
        $this->index_fields = ['الاسم ' => 'name', 'رقم الجوال' => 'mobile', 'البريد الالكترونى' => 'email'];
        $this->create_fields = ['الاسم ' => 'name', 'رقم الجوال' => 'mobile', 'البريد الالكترونى' => 'email','اللوجو'=>'image'];
        $this->update_fields = ['الاسم ' => 'name', 'رقم الجوال' => 'mobile', 'البريد الالكترونى' => 'email'];
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->where('type','provider')->latest()->get();
        return view('admin.' . $this->route . '.index', compact('rows'));
    }

    public function new_providers()
    {
        $rows = $this->model->where(['type'=>'provider','admin_status'=>'pinned'])->latest()->get();
        return view('admin.provider.news', compact('rows'));
    }

    public function approved_providers()
    {
        $rows = $this->model->where(['type'=>'provider','admin_status'=>'approved'])->latest()->get();
        return view('admin.provider.index', compact('rows'));
    }
    public function blocked_providers()
    {
        $rows = $this->model->where(['type'=>'provider','admin_status'=>'blocked'])->latest()->get();
        return view('admin.provider.index', compact('rows'));
    }
    public function block_provider($id)
    {
        $this->model->find($id)->update(['admin_status' => 'blocked']);
        return back()->with('notice', 'تم الرفض بنجاح');
    }
    public function approve_provider($id)
    {
        $this->model->find($id)->update(['admin_status' => 'approved']);
     //   $user=User::find($id);
//        $push = new PushNotification('fcm');
//        $user->device_type=='IOS'? $not=array('title'=>'رسالة إدارية', 'sound' => 'default') : $not=null;
//        $msg = [
//            'notification' => $not,
//            'data' => [
//                'title'=>'رسالة إدارية',
//                'body' => 'تمت الموافقة على طلب انضمامك',
//                'status' => 'admin',
//                'type'=>'admin'
//            ],
//            'priority' => 'high',
//        ];
//        $tokens=[];
//        if(is_array($user->device_token)){
//            foreach ($user->device_token as $value){
//                $tokens[]= $value;
//            }
//        }else{
//            foreach ((array)$user->device_token as $value){
//                $tokens[]= $value;
//            }
//        }
//
//        $push->setMessage($msg)
//            ->setDevicesToken($tokens)
//            ->send();
//        Notification::create([
//            'title'=>'رسالة إدارية',
//            'type'=>'admin',
//            'note'=>'تمت الموافقة على طلب انضمامك',
//            'receiver_id'=>$id,
//        ]);
        return back()->with('notice', 'تم التفعيل بنجاح');
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
