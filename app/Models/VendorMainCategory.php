<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorMainCategory extends Model
{
    protected $table='vendor_maincategories';

    protected $fillable=['id','vendor_id','category_id'];

    public function vendors(){

        return $this->hasMany(Vendor::class,'vendor_id');
    }

    public function category(){

        return $this->belongsTo(MainCategory::class,'category_id');
    }
}
