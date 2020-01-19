<?php

namespace App;

class Package extends MasterModel
{
    protected $fillable = [
        'period', 'name', 'price'
    ];

    protected $casts = [
        'name' => 'json',
    ];

    protected $index_fields = [
        'id', 'period', 'price'
    ];
    protected $json_fields = [
        'name'
    ];
}
