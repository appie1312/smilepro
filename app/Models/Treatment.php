<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Treatment extends Model
{
    protected $fillable = [
        'employee_id',
        'patient_id',
        'datum',
        'tijd',
        'behandeling_type',
        'omschrijving',
        'kosten',
        'status',
        'is_actief',
        'opmerking',
    ];

    protected $casts = [
        'datum' => 'date',
        'tijd' => 'datetime:H:i',
        'kosten' => 'decimal:2',
        'is_actief' => 'boolean',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
