<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Availability extends Model
{
    protected $fillable = [
        'employee_id',
        'datum_vanaf',
        'datum_tot_met',
        'tijd_vanaf',
        'tijd_tot_met',
        'status',
        'is_actief',
        'opmerking',
    ];

    protected $casts = [
        'datum_vanaf' => 'date',
        'datum_tot_met' => 'date',
        'tijd_vanaf' => 'datetime:H:i',
        'tijd_tot_met' => 'datetime:H:i',
        'is_actief' => 'boolean',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
