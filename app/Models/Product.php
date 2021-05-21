<?php

namespace App\Models;

use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';


    protected $fillable=['name','description','vendor_id','sub_category','status','price','photo','created_at','updated_at'];

    public function vendor(){

        return $this->belongsTo(Vendor::class,'vendor_id');
    }



}

