<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Job;
use App\Models\Application;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'jobs' => Job::count(),
            'applications' => Application::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
