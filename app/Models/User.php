<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'user';

    protected $fillable = [
      'name',
      'email',
      'password',
      'role'
    ];

    protected $hidden = [
      'password',
  ];

  public function transaction() : HasMany
  {
      return $this->hasMany(Transaction::class);
  }
}
