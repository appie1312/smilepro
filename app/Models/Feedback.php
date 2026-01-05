<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    protected $fillable = [
        'patient_id',
        'beoordeling',
        'praktijk_email',
        'praktijk_telefoon',
        'is_actief',
        'opmerking',
    ];

    protected $casts = [
        'beoordeling' => 'integer',
        'is_actief' => 'boolean',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
