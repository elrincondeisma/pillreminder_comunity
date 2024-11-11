<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Treatment extends Model
{
    //
    protected $fillable = [
        'medicine_id',
        'dosage',
        'frequency',
        'start_date',
        'end_date',
        'vial_type',
        'custom_vial_type',
        'alternate_route',
        'first_route',
        'notify_feedback',
        'notify_pain',
        'is_active',
        'location',
        'custom_location',
    ];

    /**
     * Get the Medicine that the Treatment belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }
    /**
     * Get the user that owns the Treatment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getEnumValues(string $column): array
    {
        $enums = [
            'vial_type' => ['oral', 'injection', 'other'],
            'location' => ['arms', 'legs', 'chest', 'abdomen', 'other'],
            'first_route' => ['left', 'right', 'indifferent'],
        ];

        return $enums[$column] ?? [];
    }
}
