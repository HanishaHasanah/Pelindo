<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipperProductionCC extends Model
{
    protected $table = 'shipper_productions_cc'; 
    protected $fillable = ['shipper_id', 'bulan', 'tahun', 'produksi'];

    public $timestamps = false;

    public function shipper()
{
    return $this->belongsTo(ShipperCC::class, 'shipper_id');
}

}
