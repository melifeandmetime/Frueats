<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListCart extends Model
{
    protected $table = 'cart';

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
