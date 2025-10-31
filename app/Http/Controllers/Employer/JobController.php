<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = $request->user()->companies()->first()->jobs()
            ->withCount('applications')
            ->latest()
            ->paginate(10);

        return view('employer.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('employer.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary_min' => 'required|numeric|min:0',
            'salary_max' => 'required|numeric|gt:salary_min',
            'type' => 'required|in:full-time,part-time,contract',
            'expires_at' => 'required|date|after:today'
        ]);

        $job = $request->user()->companies()->first()->jobs()->create([
            ...$validated,
            'status' => 'pending',
            'posted_at' => now(),
        ]);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job posted successfully and awaiting approval');
    }

    public function edit(Job $job)
    {
        $this->authorize('manage-jobs', $job->company);
        return view('employer.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $this->authorize('manage-jobs', $job->company);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary_min' => 'required|numeric|min:0',
            'salary_max' => 'required|numeric|gt:salary_min',
            'type' => 'required|in:full-time,part-time,contract',
            'expires_at' => 'required|date|after:today'
        ]);

        $job->update($validated);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job updated successfully');
    }

    public function destroy(Job $job)
    {
        $this->authorize('manage-jobs', $job->company);
        $job->delete();

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job deleted successfully');
    }
}
