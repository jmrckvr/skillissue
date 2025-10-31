<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_employers' => User::where('role', 'employer')->count(),
            'total_applicants' => User::where('role', 'applicant')->count(),
            'total_jobs' => Job::count(),
            'pending_jobs' => Job::where('status', 'pending')->count(),
            'total_applications' => Application::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
