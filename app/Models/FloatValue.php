<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloatValue extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function iotData()
    {
        return $this->belongsTo(IotData::class);
    }
}
