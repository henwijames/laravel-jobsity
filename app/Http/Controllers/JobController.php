<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);


        return redirect('/jobs')->with('success', 'Job created successfully');
    }

    public function edit(Job $job)
    {
        if (Auth::guest()) {
            return redirect('/login')->with('error', 'You must be logged in to edit a job');
        }

        if ($job->employer->user->isNot(Auth::user())) {
            return redirect('/jobs')->with('error', 'You are not authorized to edit this job');
        }

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
