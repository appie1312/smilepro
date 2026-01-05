<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'person_id',
        'nummer',
        'medewerker_type',
        'specialisatie',
        'startdatum',
        'einddatum',
        'is_actief',
        'opmerking',
    ];

    protected $casts = [
        'startdatum' => 'date',
        'einddatum' => 'date',
        'is_actief' => 'boolean',
    ];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function availabilities(): HasMany
    {
        return $this->hasMany(Availability::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }

    public function communications(): HasMany
    {
        return $this->hasMany(Communication::class);
    }
}
