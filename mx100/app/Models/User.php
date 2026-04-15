<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// Pastikan HasApiTokens ada jika kamu pakai Sanctum nanti
use Laravel\Sanctum\HasApiTokens; 

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Tambahkan role di sini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi: Employer memiliki banyak Jobs
    public function jobs()
    {
        return $this->hasMany(Job::class, 'employer_id');
    }

    // Relasi: Freelancer memiliki banyak Applications
    public function applications()
    {
        return $this->hasMany(Application::class, 'freelancer_id');
    }
}