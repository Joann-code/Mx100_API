<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        // ... kode yang sudah ada ...
    }

    public function store(Request $request)
    {
        // ... kode yang sudah ada ...
    }

    // --- TARUH DI SINI ---
    // Fitur Employer: Melihat siapa saja yang melamar di lowongan miliknya
    public function showApplications(Request $request, $id)
    {
        // Cari job, pastikan memang milik employer yang sedang login
        $job = $request->user()->jobs()->where('id', $id)->first();

        if (!$job) {
            return response()->json([
                'message' => 'Lowongan tidak ditemukan atau Anda tidak memiliki akses.'
            ], 403);
        }

        // Ambil data pelamar beserta info user-nya (Freelancer)
        $applications = $job->applications()->with('freelancer:id,name,email')->get();

        return response()->json([
            'message' => 'Daftar pelamar untuk lowongan: ' . $job->title,
            'data' => $applications
        ]);
    }
}