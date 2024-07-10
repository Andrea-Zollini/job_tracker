<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthenticatedViewController extends Controller
{
    public function index()
    {
        $applications = JobApplication::query()
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        // dd($applications);
        return Inertia::render('Index', [
            'applications' => $applications,
        ]);
    }


    public function create()
    {
        return Inertia::render('Create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $slug)
    {
        $application = auth()->user()->jobApplications()->where('slug', $slug)->first();
        return Inertia::render('Show', [
            'application' => $application,
        ]);
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $slug)
    {
        $application = auth()->user()->jobApplications()->where('slug', $slug)->first();
        $application->delete();
        return redirect()->route('dashboard');
    }
}
