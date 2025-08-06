<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'name'
    ];

    protected $hidden = [
        'password'
    ];

    // Mutator untuk hash password otomatis
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // Method untuk verify password
    public function verifyPassword($password)
    {
        return Hash::check($password, $this->password);
    }
}
