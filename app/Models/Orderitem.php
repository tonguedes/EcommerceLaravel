<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
    protected $table ='order_items';
    protected $fillable=[
        'order_id',
        'product_id',
        'product_color_id',
        'quantity',
        'price'
    ];
    use HasFactory;
}
