<?php

namespace App;

use Edujugon\PushNotification\PushNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MasterModel extends Model
{
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    protected $model;         // model name
    protected $route;         // route name
    protected $index_fields;  // response for mobile

    public function setImageAttribute()
    {
        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $destinationPath = 'images/' . $this->route;
            $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $this->attributes['image'] = $filename;
        }
    }

    public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            return asset('images/') . $this->route . '/' . $this->attributes['image'];
        }
        return asset('images/user/admin.png');
    }

    public function static_model()
    {
        $arr = [];
        $lang = request()->header('lang', 'ar');
        foreach ($this->index_fields as $index_field) {
            if (substr($index_field, "-3") == '_id') {
                $related_model = substr_replace($index_field, "", -3);
                if ($this->$related_model != null) {
                    $model = $this->$related_model->static_model();
                    $arr[$related_model] = $model;
                }
            } elseif (substr($index_field, "-3") != '_id') {
                if ($this->$index_field) {
                    $arr[$index_field] = $this->$index_field;
                }
            }
        }
        if ($this->json_fields) {
            foreach ($this->json_fields as $json_field) {
                $this->$json_field[$lang] ? $arr[$json_field] = $this->$json_field[$lang] : $arr[$json_field] = '';
            }
        }
        return $arr;
    }

    public function single_notify($sender, $receiver, $order, $title, $status)
    {
        $receiver->device_type == 'ios' ? $not = array('title' => $title, 'sound' => 'default') : $not = null;
        $push = new PushNotification('fcm');
        $msg = [
            'notification' => $not,
            'data' => [
                'title' => $title,
                'body' => $title,
                'status' => $status,
                'type' => $status
            ],
            'priority' => 'high',
        ];
        $push->setMessage($msg)
            ->setDevicesToken($receiver->device_token)
            ->send();
        $notification = new Notification();
        $notification->title = $title;
        $notification->note = $title;
        $notification->sender_id = $sender->id;
        $notification->receiver_id = $receiver->id;
        $notification->order_id = $order->id;
        $notification->save();
    }
}
