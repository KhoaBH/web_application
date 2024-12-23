<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'email',
        'phone',
        'address',
        'description',
    ];

    // Một Seller thuộc về một User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
