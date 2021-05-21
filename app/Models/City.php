<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table='cities';

    protected $fillable=['id','name'];

    public $timestamps=false;
}
