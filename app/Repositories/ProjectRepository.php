<?php
/**
 * Created by PhpStorm.
 * User: fitter
 * Date: 3/25/17
 * Time: 5:55 PM
 */

namespace App\Repositories;
use App\Models\Project;
use App\User;

class ProjectRepository
{
    public function forUser(User $user)
    {
        return $user->projects()->get();

    }

    public function getById(User $user, $id)
    {
        return $user->projects()->find($id);
    }
}