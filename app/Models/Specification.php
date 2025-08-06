<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specification extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'weight',
        'description',
        'is_active'
    ];

    protected $casts = [
        'weight' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    // Relationship dengan Smartphones (many-to-many)
    public function smartphones()
    {
        return $this->belongsToMany(Smartphone::class, 'smartphone_specifications')
                   ->withPivot('value')
                   ->withTimestamps();
    }

    // Scope untuk active specifications
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
