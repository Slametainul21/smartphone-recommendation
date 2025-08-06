<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Smartphone extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'full_name',
        'category_id',
        'price_min',
        'price_max',
        'ram',
        'storage',
        'battery',
        'camera',
        'description',
        'image_url',
        'is_active'
    ];

    protected $casts = [
        'price_min' => 'decimal:0',
        'price_max' => 'decimal:0',
        'is_active' => 'boolean'
    ];

    // Relationship dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship dengan Specifications (many-to-many)
    public function specifications()
    {
        return $this->belongsToMany(Specification::class, 'smartphone_specifications')
                   ->withPivot('value')
                   ->withTimestamps();
    }

    // Scope untuk active smartphones
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Method untuk format harga
    public function getFormattedPriceAttribute()
    {
        if ($this->price_min == $this->price_max) {
            return 'Rp ' . number_format($this->price_min, 0, ',', '.');
        }
        return 'Rp ' . number_format($this->price_min, 0, ',', '.') . ' - Rp ' . number_format($this->price_max, 0, ',', '.');
    }
}
