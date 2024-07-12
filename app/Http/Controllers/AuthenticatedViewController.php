<?php

namespace App\Http\Controllers;

use App\ApplicationStatus;
use App\JobType;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AuthenticatedViewController extends Controller
{
    public function index()
    {
        $applications = JobApplication::query()
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return Inertia::render('Index', [
            'applications' => $applications,
        ]);
    }


    public function create()
    {
        return Inertia::render('Create', [
            'statuses' => ApplicationStatus::cases(),
            'job_types' => JobType::cases(),
            'mode' => 'create',
            'application' => null,
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_title' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'location' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'job_type' => ['required', 'string', 'max:255'],
        ]);
        $application = JobApplication::create([
            'user_id' => auth()->user()->id,
            'job_title' => $job_title = $validated['job_title'],
            'slug' => Str::slug($job_title),
            'company_name' => $validated['company_name'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'status' => Str::snake($validated['status']),
            'job_type' => Str::snake($validated['job_type']),
        ]);
        $application->save();
        return redirect()->route('dashboard')->with('message', 'Application Created Successfully.');
    }


    public function show(string $slug)
    {
        $application = auth()->user()->jobApplications()->where('slug', $slug)->first();
        return Inertia::render('Show', [
            'application' => $application,
            'statuses' => ApplicationStatus::cases(),
            'job_types' => JobType::cases(),
            'mode' => 'edit',
        ]);
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        $application = auth()->user()->jobApplications()->where('slug', $id)->first();
        $validated = $request->validate([
            'job_title' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'location' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'job_type' => ['required', 'string', 'max:255'],
        ]);
        $application->update([
            'job_title' => $job_title = $validated['job_title'],
            'company_name' => $validated['company_name'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'status' => Str::snake($validated['status']),
            'job_type' => Str::snake($validated['job_type']),
        ]);
        return redirect()->route('dashboard')->with('message', 'Application Updated Successfully.');
    }


    public function destroy(string $slug)
    {
        $application = auth()->user()->jobApplications()->where('slug', $slug)->first();
        $application->delete();
        return redirect()->route('dashboard')->with('message', 'Application Deleted Successfully.');
    }
}
