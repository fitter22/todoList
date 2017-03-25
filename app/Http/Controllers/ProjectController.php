<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projects;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->middleware('auth');

        $this->projects = $projectRepository;
    }

    public function index(Request $request)
    {
        $projects = $this->projects->forUser($request->user());

        return view('projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $request->user()->projects()->create([
            'name' => strip_tags($request->input('name')),
        ]);

        return redirect('/projects');
    }

    public function destroy(Request $request, Project $project)
    {
        $this->authorize('destroy', $project);

        $project->delete();

        return redirect('/projects');
    }
}

