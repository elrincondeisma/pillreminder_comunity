<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medicine extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'is_active',
        'image',
    ];
    /**
     * Get all of the treatments for the Medicine
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }
}
