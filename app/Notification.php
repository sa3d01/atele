<?php

namespace App;

class Notification extends MasterModel
{
    protected $fillable = [
        'type', 'sender_id', 'receiver_id', 'order_id', 'title', 'note'
    ];
    protected $index_fields = ['id', 'sender_id', 'receiver_id', 'order_id'];
    protected $json_fields = [
        'title','note'
    ];
    protected $casts = [
        'title' => 'json',
        'note' => 'json',
    ];
//    public function sender()
//    {
//        return $this->belongsTo(User::class, 'sender_id');
//    }
//    public function receiver()
//    {
//        return $this->belongsTo(User::class, 'receiver_id');
//    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
