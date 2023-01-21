<?php

namespace Safitech\Iot\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Safitech\Iot\Database\Factories\BooleanValueFactory;

class BooleanValue extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected static function newFactory()
    {
        return BooleanValueFactory::new();
    }
}
