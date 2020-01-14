<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Mail\ConfirmCode;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function validation_rules($method, $id = null)
    {
        if ($method == 2) {
            $rules['mobile'] = 'unique:users,mobile,' . $id;
            $rules['email'] = 'email|max:255|unique:users,email,' . $id;
        } else {
            $rules = [
                'mobile' => 'required|unique:users|max:13',
                'email' => 'required|unique:users|email|max:255',
                'name' => 'required',
                'password' => 'required',
                'device_token' => 'required',
            ];
        }
        return $rules;
    }

    public function validation_messages($lang = 'ar')
    {
        $messsages = array(
            'email.unique' => 'هذا البريد مسجل بالفعل',
            'mobile.unique' => 'هذا الهاتف مسجل بالفعل',
            'mobile.required' => 'يجب ادخال رقم الهاتف',
            'email.required' => 'يجب ادخال البريد',
        );
        return $messsages;
    }

    public function update_apiToken($user)
    {
        $user->update(['apiToken' => Str::random(80)]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),$this->validation_rules(1),$this->validation_messages());
        if ($validator->fails()) {
            return response()->json(['status' => 400, 'msg' =>$validator->errors()->first()],400);
        }
        $activation_code = rand(1111, 9999);
        $all = $request->all();
        $all['activation_code'] = $activation_code;
        $user = User::create($all);
        $user->refresh();
        $this->update_apiToken($user);
        Mail::to($user->email)->send(new ConfirmCode($activation_code));
        $user->refresh();
        return response()->json(['status' => 200,'activation_code'=>$user->activation_code,'apiToken'=>$user->apiToken, 'data' => $user->static_model()]);
    }

    public function resend_code(Request $request)
    {
        $validate = Validator::make($request->all(), ['email' => 'required']);
        if ($validate->fails()) {
            return response()->json(['status' => 400, 'msg' => 'البريد الالكترونى مطلوب'],400);
        }
        $user = User::where('email', $request['email'])->first();
        if ($user) {
            $activation_code = rand(1111, 9999);
            $user->activation_code = $activation_code;
            $this->update_apiToken($user);
            $user->update();
            $msg = ' كود التفعيل الخاص بالتيليه' . $activation_code;
            //   $user->sendMessage($msg,$user->mobile);
            return response()->json(['status' => 200,'activation_code'=>$user->activation_code,'apiToken'=>$user->apiToken, 'data' => $user->static_model()]);
        } else {
            return response()->json(['status' => 400, 'msg' => 'هذا البريد غير مسجل من قبل'],400);
        }
    }

    public function activate(Request $request)
    {
        $split = explode("sa3d01", $request->header('apiToken'));
        $user = User::where('apiToken', $split['1'])->first();
        if(!$user)
            return response()->json(['status' => 401],401);
        if (!$request['activation_code'] || ($user->activation_code != $request['activation_code'])) {
            return response()->json(['status' => 400, 'msg' => 'رقم التفعيل غير صحيح'],400);
        }
        $user->update(['status' => 1, 'activation_code' => null]);
        $user->refresh();
        return response()->json(['status' => 200,'apiToken'=>$user->apiToken, 'data' => $user->static_model()]);
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), ['email' => 'required']);
        if ($validate->fails()) {
            return response()->json(['status' => 400, 'msg' => 'البريد الالكترونى مطلوب'],400);
        }
        $user = User::where('email', $request['email'])->first();
        if(!$user){
            return response()->json(['status' => 400, 'msg' => 'المستخدم غير موجود'],400);
        }
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password') ,'approved'=>'false'])){
            $msg = 'تم حظرك من قبل ادارة التطبيق';
            return response()->json(['status' => 400, 'msg' => $msg]);
        }
        if ($user->status == 1) {
            $this->update_apiToken($user);
            $user->update();
            $user->refresh();
            return response()->json(['status' => 200,'apiToken'=>$user->apiToken,'data' => $user->static_model()]);
        } elseif($user->status ==0) {
            $activation_code = rand(1111, 9999);
            $user->update(['activation_code' => $activation_code]);
            $this->update_apiToken($user);
            $user->refresh();
            $msg = ' كود التفعيل الخاص باتيليه' . $activation_code;
            //   $user->sendMessage($msg,$user->mobile);
            return response()->json(['status' => 200,'activation_code'=>$user->activation_code,'apiToken'=>$user->apiToken, 'data' => $user->static_model()]);
        }
    }


    public function update_profile(Request $request)
    {
        $split = explode("sa3d01", $request->header('apiToken'));
        $user = User::where('apiToken', $split['1'])->first();
        $validator = Validator::make($request->all(), $this->validation_rules(2, $user->id), $this->validation_messages());
        if ($validator->passes()) {
            $all = $request->all();
            $user->update($all);
            $user->refresh();
            return response()->json(['status' => 200, 'data' => $user->static_model()]);
        } else {
            return response()->json(['status' => 400, 'msg' => $validator->errors()->first()]);
        }
    }

    public function show($id, Request $request)
    {
        $row = User::find($id);
        if (!$row)
            return response()->json(['status' => 400, 'msg' => 'something happen']);
        return response()->json(['status' => 200, 'data' => $row->static_model()]);
    }
}
