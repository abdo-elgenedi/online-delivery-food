<?php

namespace App\Models;

use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table='main_categories';


    protected $fillable=['name','photo','active','created_at','updated_at'];


    public function scopeActive($query){

        return $query -> where('active','1');
    }
    public function vendors(){
        return $this->hasMany(Vendor::class,'category_id','id');
    }

    public function subCategoryies(){
        return $this->hasMany(CategoryLevel1::class,'parent_id','id');
    }
}
