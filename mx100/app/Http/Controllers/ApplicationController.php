<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    // Fitur Freelancer: Melamar pekerjaan (Upload CV)
    public function apply(Request $request, $jobId)
    {
        // 1. Cek apakah yang akses adalah freelancer
        if ($request->user()->role !== 'freelancer') {
            return response()->json([
                'message' => 'Hanya freelancer yang bisa melamar pekerjaan.'
            ], 403);
        }

        // 2. Pastikan lowongan kerja ada dan statusnya "published"
        $job = Job::where('id', $jobId)->where('status', 'published')->first();
        if (!$job) {
            return response()->json([
                'message' => 'Lowongan tidak ditemukan atau belum dipublish.'
            ], 404);
        }

        // 3. BUSINESS LOGIC: Cek apakah freelancer sudah pernah melamar di job ini
        $hasApplied = Application::where('job_id', $jobId)
                                 ->where('freelancer_id', $request->user()->id)
                                 ->exists();
        if ($hasApplied) {
            return response()->json([
                'message' => 'Gagal. Anda sudah pernah mengirim CV untuk lowongan ini.'
            ], 400); // 400 Bad Request
        }

        // 4. Validasi file CV (wajib PDF, maksimal 2MB)
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:2048'
        ]);

        // 5. Simpan file CV ke folder storage
        $cvPath = $request->file('cv')->store('cv_files', 'public');

        // 6. Simpan data lamaran ke database
        $application = Application::create([
            'job_id' => $jobId,
            'freelancer_id' => $request->user()->id,
            'cv_path' => $cvPath
        ]);

        return response()->json([
            'message' => 'Berhasil melamar pekerjaan!',
            'data' => $application
        ], 201);
    }
}