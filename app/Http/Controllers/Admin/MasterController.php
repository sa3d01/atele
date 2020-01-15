<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Order;
use App\User;
use Illuminate\Http\Request;

abstract class MasterController extends Controller
{

    protected $model;
    protected $route;
    protected $module_name;
    protected $single_module_name;
    protected $index_fields;
    protected $show_fields;
    protected $create_fields;
    protected $update_fields;
    protected $json_fields;

    public function __construct()
    {
        $users=User::whereType('user')->get();
        $providers=User::whereType('provider')->get();
        $money=Invoice::sum('total_price');
        $waiting_orders=Order::whereStatus('waiting')->get();
        $assigned_orders=Order::whereStatus('assigned')->get();
        $done_orders=Order::whereStatus('done')->get();
        $cancelled_orders=Order::whereStatus('cancelled')->get();
        $parent_categories=Category::where('parent_id',null)->get();
        $category_array=[];
        $category_array[null] = "قسم رئيسـي";
        foreach ( $parent_categories as $category) {
            $category_array[$category->id] = $category->name['ar'];
        }
        $this->middleware('auth:admin');
        view()->share(array(
            'module_name' => $this->module_name,
            'single_module_name' => $this->single_module_name,
            'route' => $this->route,
            'index_fields' => $this->index_fields,
            'show_fields' => $this->show_fields,
            'create_fields' => $this->create_fields,
            'update_fields' => $this->update_fields,
            'json_fields' => $this->json_fields,
            //
            'parent_categories'=>$category_array,
            'money'=>$money,
            'users'=>$users,
            'providers'=>$providers,
            'waiting_orders'=>$waiting_orders,
            'assigned_orders'=>$assigned_orders,
            'done_orders'=>$done_orders,
            'cancelled_orders'=>$cancelled_orders
        ));
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('admin.' . $this->route . '.index', compact('rows'));
    }

    public function create() {
        return view('admin.'.$this->route.'.create');
    }

    public function store(Request $request) {
        $this->validate($request, $this->validation_func(1));
        $this->model->create($request->all());
        return redirect('admin/'.$this->route.'')->with('created', 'تمت الاضافة بنجاح');
    }

    public function edit($id) {
        $row = $this->model->find($id);
        return View('admin.'.$this->route.'.edit', compact('row'));
    }

    public function update($id, Request $request) {
        $this->validate($request, $this->validation_func(2,$id));
        $obj=$this->model->find($id);
        $obj->update($request->all());
        return redirect('admin/'.$this->route.'')->with('updated','تم التعديل بنجاح');
    }

    public function destroy($id) {
        $this->model->find($id)->delete();
        return redirect('admin/'.$this->route.'')->with('deleted','تم الحذف بنجاح');
    }

    public function show($id)
    {
        $row = $this->model->find($id);
        return View('admin.'.$this->route.'.show', compact('row'));
    }

}

