<?php

namespace Safitech\Iot\App\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Safitech\Iot\App\Models\Concerns\HasFactoryResolver;

abstract class BaseIotModel extends Model
{
    use HasFactory, HasFactoryResolver;

    public $guarded = ['id'];

    protected static function newFactory()
    {
        return static::resolveFactoryClass()::new();
    }
}
