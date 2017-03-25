<?php

namespace App\Http\Controllers;

use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $tasks;
    protected $projectRepository;

    public function __construct(TaskRepository $tasks, ProjectRepository $projectRepository)
    {
        //user must be logged in to see page using this controller
        $this->middleware('auth');

        $this->projectRepository = $projectRepository;

        $this->tasks = $tasks;
    }

    public function index(Request $request, $projectId)
    {
        $project = $this->projectRepository->getById($request->user(), $projectId);

        $tasks = $this->tasks->forProject($project);


        return view('tasks.index', compact('tasks', 'project'));
    }

    public function store(Request $request, $projectId)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'priority' => 'required|digits_between:1,3|integer'
        ]);

        $project = $this->projectRepository->getById($request->user(), $projectId);


        $project->tasks()->create([
            'name' => strip_tags($request->input('name')),
            'priority' => strip_tags($request->input('priority'))
        ]);

        return redirect('/project/' . $projectId . '/tasks');
    }

    public function destroy(Request $request, $projectId, Task $task)
    {
        $project = $this->projectRepository->getById($request->user(), $projectId);

        $this->authorize('destroy', $project);

        $task->delete();

        return redirect('/project/' . $projectId . '/tasks');
    }
}