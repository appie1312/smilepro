<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Communication extends Model
{
    protected $fillable = [
        'patient_id',
        'employee_id',
        'bericht',
        'verzonden_datum',
        'is_actief',
        'opmerking',
    ];

    protected $casts = [
        'verzonden_datum' => 'datetime',
        'is_actief' => 'boolean',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
