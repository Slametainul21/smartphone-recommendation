<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relationship dengan Smartphone
    public function smartphones()
    {
        return $this->hasMany(Smartphone::class);
    }

    // Scope untuk active categories
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
