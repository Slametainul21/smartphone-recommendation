<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmartphoneSpecification extends Model
{
    use HasFactory;

    protected $fillable = [
        'smartphone_id',
        'specification_id',
        'value'
    ];

    protected $casts = [
        'value' => 'decimal:2'
    ];

    // Relationship dengan Smartphone
    public function smartphone()
    {
        return $this->belongsTo(Smartphone::class);
    }

    // Relationship dengan Specification
    public function specification()
    {
        return $this->belongsTo(Specification::class);
    }
}
