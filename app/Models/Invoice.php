<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $table='invoices';
    protected $fillable=[
      'id','total_price','user_id','vendor_id','address','notes','created_at','status'
    ];

    public function orders(){

        return $this->hasMany(Order::class,'invoice_id');
    }

    public function vendor(){

       return $this->belongsTo(Vendor::class,'vendor_id');
    }

    public function customer(){

        return $this->belongsTo(User::class,'user_id');
    }


}
