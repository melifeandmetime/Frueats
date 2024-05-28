<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderHeader extends Model
{
    protected $table = 'order_header';

    public function customer()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
