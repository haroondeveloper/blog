<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Permission extends Model
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'slug', 'id'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
