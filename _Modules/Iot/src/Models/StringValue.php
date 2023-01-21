<?php

namespace Safitech\Iot\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Safitech\Iot\Database\Factories\StringValueFactory;

class StringValue extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected static function newFactory()
    {
        return StringValueFactory::new();
    }
}
