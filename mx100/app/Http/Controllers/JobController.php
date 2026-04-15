<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::where('status', 'published')->get();

        return response()->json([
            'message' => 'Berhasil mengambil daftar lowongan pekerjaan',
            'data' => $jobs
        ], 200);
    }

    public function store(Request $request)
    {
        // (Biarkan isi kodingan store kamu yang asli di sini, jangan dihapus)
    }

    // Fitur Employer: Melihat siapa saja yang melamar di lowongan miliknya
    public function showApplications(Request $request, $id)
    {
        $job = $request->user()->jobs()->where('id', $id)->first();

        if (!$job) {
            return response()->json([
                'message' => 'Lowongan tidak ditemukan atau Anda tidak memiliki akses.'
            ], 403);
        }

        $applications = $job->applications()->with('freelancer:id,name,email')->get();

        return response()->json([
            'message' => 'Daftar pelamar untuk lowongan: ' . $job->title,
            'data' => $applications
        ]);
    }
}
