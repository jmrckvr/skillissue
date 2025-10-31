<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function create()
    {
        return view('employer.companies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'logo' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('company-logos', 'public');
            $validated['logo_url'] = $path;
        }

        $company = $request->user()->companies()->create($validated);

        return redirect()->route('employer.dashboard')
            ->with('success', 'Company profile created successfully');
    }

    public function edit(Company $company)
    {
        $this->authorize('manage-company', $company);
        return view('employer.companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $this->authorize('manage-company', $company);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'logo' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('company-logos', 'public');
            $validated['logo_url'] = $path;
        }

        $company->update($validated);

        return redirect()->route('employer.dashboard')
            ->with('success', 'Company profile updated successfully');
    }
}
