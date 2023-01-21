<?php

namespace Safitech\Iot\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Safitech\Iot\Database\Factories\TopicFactory;

class Topic extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'rules' => 'array',
        'retain' => 'boolean',
    ];

    protected static function newFactory()
    {
        return TopicFactory::new();
    }
}
