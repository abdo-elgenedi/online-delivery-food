<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';
    protected $fillable=[
        'id','product_id','invoice_id','quantity','created_at'
    ];

    public function product(){

        return $this->belongsTo(Product::class,'product_id');
    }
}
