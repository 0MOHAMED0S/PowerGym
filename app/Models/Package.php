<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'price',
        'status'
    ];

    public function features(): HasMany
    {
        return $this->hasMany(features::class);
    }

    public function subscriber(): HasOne
    {
        return $this->hasOne(Subscribe::class);
    }
}
