<?php

namespace App\Models;

use App\Packages\ParsedTopic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'rules' => 'array',
        'retain' => 'boolean',
    ];

    // --------------------------------------------
    // routing
    // --------------------------------------------

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        if (ctype_digit($value) && is_int((int) $value)) {
            return $this->findOrFail($value);
        }

        if (ParsedTopic::isCanonical($value)) {
            return $this->where('topic', $value)->firstOrFail();
        }

        return $this->where('topic', "%u/%d/$value")->firstOrFail();
    }
}
