<?php
/**
 * Created by PhpStorm.
 * User: fitter
 * Date: 3/25/17
 * Time: 3:43 PM
 */

namespace App\Repositories;
use App\Models\Project;

class TaskRepository
{
    public function forProject(Project $project)
    {
        return $project->tasks()->orderBy('priority', 'asc')->get();
    }
}