<?php

namespace Safitech\Iot\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Safitech\Iot\Models\Concerns\HasFactoryResolver;

abstract class BaseIotModel extends Model
{
    use HasFactory, HasFactoryResolver;

    public $guarded = ['id'];

    protected static function newFactory()
    {
        return static::resolveFactoryClass()::new();
    }
}
