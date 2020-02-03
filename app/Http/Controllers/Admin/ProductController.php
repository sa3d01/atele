<?php

namespace App\Http\Controllers\Admin;

use App\Package;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends MasterController
{
    public function __construct(Product $model)
    {
        $this->model = $model;
        $this->route = 'product';
        $this->module_name         = 'قائمة المنتجات ';
        $this->single_module_name  = 'منتج';
        $this->index_fields        = ['اسم المنتج' => 'title','وصف المنتج' => 'note','سعر المنتج ' => 'price'];
        $this->create_fields        = ['اسم المنتج' => 'title','وصف المنتج' => 'note','سعر المنتج ' => 'price'];
        $this->update_fields        = ['اسم المنتج' => 'title','وصف المنتج' => 'note','سعر المنتج ' => 'price'];
        parent::__construct();
    }

    public function validation_func($method,$id=null)
    {
        $therulesarray = [];
        $therulesarray['title'] ='required';
        $therulesarray['note'] ='required';
        $therulesarray['price'] ='required';
        return $therulesarray;
    }
    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('admin.' . $this->route . '.index', compact('rows'));
    }
    public function store(Request $request)
    {
        $this->validate($request, $this->validation_func(1));
        $file = $request->logo;
        $destinationPath = 'images/bank/';
        $filename = str_random(10).'.'.$file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);
        Bank::create([
            'name'=>$request['name'],
            'account_number'=>$request['account_number'],
            'iban_number'=>$request['iban_number'],
            'logo'=>$filename,
        ]);
        return redirect('admin/' . $this->route . '')->with('created', 'تمت الاضافة بنجاح');
    }
    public function update($id, Request $request)
    {
        $this->validate($request, $this->validation_func(2, $id));
        $obj = $this->model->find($id);
        if($request->hasFile('logo')){
            $file = $request->logo;
            $destinationPath = 'images/bank/';
            $filename = str_random(10).'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $obj->update([
                'name'=>$request['name'],
                'account_number'=>$request['account_number'],
                'iban_number'=>$request['iban_number'],
                'logo'=>$filename,
            ]);
        }else{
            $obj->update([
                'name'=>$request['name'],
                'account_number'=>$request['account_number'],
                'iban_number'=>$request['iban_number'],
            ]);
        }
        return redirect('admin/' . $this->route . '')->with('updated', 'تم التعديل بنجاح');
    }


}
