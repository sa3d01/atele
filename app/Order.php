<?php

namespace App;

use Carbon\Carbon;
use App\Notification;
use App\User;
use App\Product;
use Edujugon\PushNotification\PushNotification;

class Order extends MasterModel
{
    protected $fillable = [
        'status', 'user_id', 'product_id', 'note', 'count'
        , 'cancel_reason','paid'
    ];
    protected $index_fields = [
        'id', 'status', 'product_id', 'note', 'count'
        , 'cancel_reason'
    ];

    public function static_model()
    {
        $arr = [];
        foreach ($this->index_fields as $index_field) {
            if (substr($index_field, "-3") == '_id') {
                $related_model = substr_replace($index_field, "", -3);
                if ($this->$related_model != null) {
                    $model = $this->$related_model->static_model();
                    $arr[$related_model] = $model;
                }
            }elseif(substr($index_field, "-3") != '_id') {
                if ($this->$index_field) {
                    $arr[$index_field] = $this->$index_field;
                }
            }
        }
        $user=User::find($this->user_id);
        $arr['user_id'] = $user->static_model();
        $arr['paid'] = $this->paid==0?false:true;
        $arr['creation_time'] = Carbon::parse($this->created_at)->diffForHumans();
        // $is_rated=Rating::where('order_id',$this->id)->first();
        // $arr['is_rated']=$is_rated?true:false;
        return $arr;
    }

    private $user;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function notify_provider()
    {
        $user = User::find($this->user_id);
        $title['ar'] = 'لديك طلب جديد عن طريق ' . $user->name;
        $title['en'] = 'you have new request from ' . $user->name;
        $product=Product::find($this->product_id);
        $provider = User::find($product->user_id);
        // $provider->device_type == 'ios' ? $not = array('title' => $title, 'sound' => 'default') : $not = null;
        // $push = new PushNotification('fcm');
        // $msg = [
        //     'notification' => $not,
        //     'data' => [
        //         'title' => $title,
        //         'body' => $title,
        //         'status' => 'new_order',
        //         'type' => 'new_order'
        //     ],
        //     'priority' => 'high',
        // ];
        // $push->setMessage($msg)
        //     ->setDevicesToken($provider->device_token)
        //     ->send();
        $notification = new Notification();
        $notification->title = $title;
        $notification->note = $title;
        $notification->sender_id = $this->user_id;
        $notification->receiver_id = $provider->id;
        $notification->order_id = $this->id;
        $notification->save();

    }

    public function single_notify($sender,$receiver,$order,$title,$status)
    {
        // $provider->device_type == 'ios' ? $not = array('title' => $title, 'sound' => 'default') : $not = null;
        // $push = new PushNotification('fcm');
        // $msg = [
        //     'notification' => $not,
        //     'data' => [
        //         'title' => $title,
        //         'body' => $title,
        //         'status' => 'new_order',
        //         'type' => 'new_order'
        //     ],
        //     'priority' => 'high',
        // ];
        // $push->setMessage($msg)
        //     ->setDevicesToken($provider->device_token)
        //     ->send();
        $notification = new Notification();
        $notification->title = $title;
        $notification->note = $title;
        $notification->sender_id = $sender->id;
        $notification->receiver_id = $receiver->id;
        $notification->order_id = $order->id;
        $notification->save();

    }

}
