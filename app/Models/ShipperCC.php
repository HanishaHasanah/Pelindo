<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipperCC extends Model
{
    protected $table = 'shippers_cc';
    protected $fillable = ['name'];
   
    public $timestamps = false;
}
