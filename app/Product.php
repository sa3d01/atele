<?php

namespace App;

class Product extends MasterModel
{
    protected $fillable = [
        'title', 'price', 'note','images','user_id'
    ];

    protected $casts = [
        'images' => 'array',
    ];

    protected $index_fields = [
        'id', 'title', 'price','note','images','user_id'
    ];
    // protected $json_fields = [
    //     'name'
    // ];
}
