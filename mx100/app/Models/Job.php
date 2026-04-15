<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'status',
    ];

    // Relasi: Job ini milik siapa (Employer)
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    // Relasi: Job ini punya banyak lamaran (Applications)
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}