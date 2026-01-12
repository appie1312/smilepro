<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAvailability extends Model
{
    protected $fillable = [
        'user_id',
        'date_from',
        'date_to',
        'time_from',
        'time_to',
        'status',
        'comment',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}