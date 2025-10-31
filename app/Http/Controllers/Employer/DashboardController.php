<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $company = $request->user()->companies()->first();

        if (!$company) {
            return redirect()->route('employer.companies.create')
                ->with('message', 'Please create your company profile first');
        }

        $stats = [
            'total_jobs' => $company->jobs()->count(),
            'active_jobs' => $company->jobs()->where('status', 'approved')->count(),
            'total_applications' => Application::whereHas('job', function ($q) use ($company) {
                $q->where('company_id', $company->id);
            })->count(),
            'recent_applications' => Application::whereHas('job', function ($q) use ($company) {
                $q->where('company_id', $company->id);
            })->latest()->take(5)->get(),
        ];

        return view('employer.dashboard', compact('stats', 'company'));
    }
}
