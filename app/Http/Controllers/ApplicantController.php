<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Filters\JobFilter;

class ApplicantController extends Controller
{
    public function index(Request $request)
    {
        $filter = new JobFilter($request);

        $jobs = Job::where('status', 'approved')
            ->where('expires_at', '>', now())
            ->with('company')
            ->filter($filter)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        $this->authorize('view', $job);
        return view('jobs.show', compact('job'));
    }

    public function apply(Request $request, Job $job)
    {
        $this->authorize('apply', $job);

        $validated = $request->validate([
            'cover_letter' => 'required|string|min:100',
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        $resumePath = $request->file('resume')->store('resumes', 'private');

        $application = $job->applications()->create([
            'applicant_id' => $request->user()->id,
            'resume_url' => $resumePath,
            'cover_letter' => $validated['cover_letter'],
            'status' => 'applied'
        ]);

        return redirect()->route('applications.index')
            ->with('success', 'Application submitted successfully');
    }

    public function applications(Request $request)
    {
        $applications = $request->user()
            ->applications()
            ->with(['job.company'])
            ->latest()
            ->paginate(10);

        return view('applications.index', compact('applications'));
    }
}
