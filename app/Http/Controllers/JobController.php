<?php

namespace App\Http\Controllers;

use App\Jobs\TranslateJob;
use App\Mail\JobPosted;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index(Job $jobs)
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(5);
        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => ['required', 'min:3'],
                'salary' => ['required'],
            ]
        );
        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        Mail::to($job->employer->user)->queue(new JobPosted($job));
        TranslateJob::dispatch($job);

        return redirect('/jobs')->with('success', 'Job created successfully');
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Request $request, Job $job)
    {
        // Validate
        $request->validate([
            'title' => 'required|min:3',
            'salary' => 'required',
        ]);

        // Update job
        $job->update($request->only('title', 'salary'));

        // Redirect to the updated job's page
        return redirect("/jobs/" . $job->id)->with('success', 'Job updated successfully');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect('/jobs')->with('success', 'Job deleted successfully');
    }
}
