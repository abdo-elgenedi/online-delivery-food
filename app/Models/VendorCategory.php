<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorCategory extends Model
{
    protected $table='vendor_categories';

    protected $fillable=['id','name','rest_id'];

    public function vendors(){

        return $this->belongsTo(Vendor::class,'rest_id');

    }

    public function products(){

        return $this->hasMany(product::class,'sub_category');

    }

}
