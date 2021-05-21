<?php

namespace App\Models;

use App\Observers\CategoryLevel1Observer;
use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Model;

class CategoryLevel1 extends Model
{
    protected $table='category_level1';


    protected $fillable=['translation_lang','translation_of','parent_id','name','slug','photo','active','last_status','created_at','updated_at'];


    public function scopeActive($query){

        return $query -> where('active','1');
    }

    public function scopeMaincat($query){

        return $query -> where('translation_of','0');
    }

    public function scopeSubcat($query,$id){
        return $query->where('parent_id',$id);
    }


    public function scopeSelection($query){

        return $query -> select('id','translation_lang','name','parent_id','slug','photo','active','translation_of');
    }

    public function categories(){
        return $this->hasMany(self::class,'translation_of');
    }

    public function vendors(){
        return $this->hasMany(Vendor::class,'category_id','id');
    }

    public function subCategoryies(){
        return $this->hasMany(CategoryLevel2::class,'parent_id','id');
    }



    public static function boot(){
        parent::boot();
        CategoryLevel1::observe(CategoryLevel1Observer::class);
    }

}
