<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'freelancer_id',
        'cv_path',
    ];

    // Relasi: Lamaran ini untuk Job apa
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    // Relasi: Lamaran ini dikirim oleh siapa (Freelancer)
    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
}