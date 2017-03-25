<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function Destroy(User $user, Project $project)
    {
        return $project->user_id === $user->id;
    }
}
