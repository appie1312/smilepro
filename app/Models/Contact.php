<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    protected $fillable = [
        'patient_id',
        'straatnaam',
        'huisnummer',
        'toevoeging',
        'postcode',
        'plaats',
        'mobiel',
        'email',
        'is_actief',
        'opmerking',
    ];

    protected $casts = [
        'is_actief' => 'boolean',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
