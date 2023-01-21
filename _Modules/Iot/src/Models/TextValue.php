<?php

namespace Safitech\Iot\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Safitech\Iot\Database\Factories\TextValueFactory;

class TextValue extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected static function newFactory()
    {
        return TextValueFactory::new();
    }
}
