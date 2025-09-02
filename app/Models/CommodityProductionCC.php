<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommodityProductionCC extends Model
{
    protected $table = 'commodity_productions_cc';

    protected $fillable = ['commodity_id','bulan','tahun','produksi',];
    public $timestamps = false;
    public function commodity()
    {
        return $this->belongsTo(CommodityCC::class, 'commodity_id');
    }
}
