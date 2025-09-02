<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommodityCC extends Model
{
    protected $table = 'commodities_cc';
    protected $fillable = ['name'];
    public $timestamps = false;
    public function commodity()
{
    return $this->belongsTo(CommodityCC::class, 'commodity_id');
}
}
