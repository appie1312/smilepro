<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Person extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'voornaam',
        'tussenvoegsel',
        'achternaam',
        'geboortedatum',
        'geslacht',
        'adres',
        'telefoonnummer',
        'email',
        'is_actief',
        'opmerking',
    ];

    protected $casts = [
        'geboortedatum' => 'date',
        'is_actief' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function patient(): HasOne
    {
        return $this->hasOne(Patient::class);
    }

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class);
    }
}
