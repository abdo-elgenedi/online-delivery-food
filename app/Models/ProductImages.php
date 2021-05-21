<?php

namespace App\Models;

use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $table='product_images';


    protected $fillable=['id','product_id','vendor_id','image'];





}

