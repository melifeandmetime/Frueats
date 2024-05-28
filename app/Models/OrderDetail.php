<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    protected $table = 'order_detail';

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
