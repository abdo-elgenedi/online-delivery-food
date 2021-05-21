<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Vendor extends Authenticatable
{
    use Notifiable;
    protected $table='vendors';

    protected $fillable=['name','username','password','mobile','city_id','state_id','delivery_fees','delivery_time','open_status','email','ssn','status','logo','created_at','updated_at'];


    public function scopeActive($query){
        return $query->where('status',1);
    }

    public function scopeSelection($query){
        return $query->select('id','name','mobile','delivery_fees','delivery_time','open_status','status','logo','city_id','state_id');
    }
    public function scopeNotPending($query){

        return $query->where('status','<>','-1');
    }

    public function scopePending($query){

        return $query->where('status','=','-1');
    }


    public function categories(){
        return $this->hasMany(VendorMainCategory::class,'vendor_id','id');
    }
    public function categoriesLimit(){
        return $this->hasMany(VendorMainCategory::class,'vendor_id','id')->limit(4);
    }

    public function vendorcategories(){
        return $this->hasMany(VendorCategory::class,'rest_id','id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
     public function state(){
        return $this->belongsTo(State::class,'state_id');
    }



    protected $dates=[
        'created_at'
    ];
}
