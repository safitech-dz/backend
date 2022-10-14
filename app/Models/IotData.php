<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IotData extends Model
{
    use HasFactory;

    public function booleanValues()
    {
        return $this->hasMany(BoolValue::class);
    }

    public function intValues()
    {
        return $this->hasMany(IntValue::class);
    }

    public function floatValues()
    {
        return $this->hasMany(FloatValue::class);
    }

    public function stringValues()
    {
        return $this->hasMany(StringValue::class);
    }

    public function textValues()
    {
        return $this->hasMany(TextValue::class);
    }

    public function dateValues()
    {
        return $this->hasMany(DateValue::class);
    }

    public function timeValues()
    {
        return $this->hasMany(TimeValue::class);
    }
}
