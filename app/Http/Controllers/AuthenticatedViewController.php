<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthenticatedViewController extends Controller
{
    public function index()
    {
        $applications = count(auth()->user()->jobApplications) ? auth()->user()->jobApplications : [];
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


    public function destroy(string $id)
    {
        //
    }
}
