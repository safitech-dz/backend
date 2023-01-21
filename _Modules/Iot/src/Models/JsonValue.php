<?php

namespace Safitech\Iot\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Safitech\Iot\Database\Factories\JsonValueFactory;

class JsonValue extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $casts = [
        'value' => 'array',
    ];

    protected static function newFactory()
    {
        return JsonValueFactory::new();
    }
}
