<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'code',
        'expired_at',
        'email_verified_at',
        'role',
        'phone_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function generateCode() {
        $this->timestamps = false;
        $this->code = rand(1000, 9999);
        $this->expired_at = now()->addMinutes(15);
        $this->save();
    }
    public function resetCode() {
        $this->timestamps = false;
        $this->code = null;
        $this->expired_at = null;
        $this->email_verified_at = now();
        $this->save();
    }

    public function image(): HasOne
    {
        return $this->hasOne(images::class);
    }
    public function subscriber(): HasOne
    {
        return $this->hasOne(Subscribe::class);
    }

        public function social(): HasOne
    {
        return $this->hasOne(Social::class);
    }
    public function favorite(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }
    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
