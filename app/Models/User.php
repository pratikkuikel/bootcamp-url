<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
            set: fn (string $value) => 'Mr. '.ucfirst($value),
        );
    }

    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function urls(): HasMany
    {
        return $this->hasMany(Url::class);
    }
}
