<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAddress extends Model
{
    // Fillable fields for mass assignment
    protected $fillable = [
        'type',
        'address1',
        'address2',
        'city',
        'state',
        'zipcode',
        'isMain',
        'country_code',
        'user_id',
    ];

    /**
     * Get the user that owns the address.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

