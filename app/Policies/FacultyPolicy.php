<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Faculty;
use Illuminate\Auth\Access\HandlesAuthorization;

class FacultyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the faculty can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list faculties');
    }

    /**
     * Determine whether the faculty can view the model.
     */
    public function view(User $user, Faculty $model): bool
    {
        return $user->hasPermissionTo('view faculties');
    }

    /**
     * Determine whether the faculty can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create faculties');
    }

    /**
     * Determine whether the faculty can update the model.
     */
    public function update(User $user, Faculty $model): bool
    {
        return $user->hasPermissionTo('update faculties');
    }

    /**
     * Determine whether the faculty can delete the model.
     */
    public function delete(User $user, Faculty $model): bool
    {
        return $user->hasPermissionTo('delete faculties');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete faculties');
    }

    /**
     * Determine whether the faculty can restore the model.
     */
    public function restore(User $user, Faculty $model): bool
    {
        return false;
    }

    /**
     * Determine whether the faculty can permanently delete the model.
     */
    public function forceDelete(User $user, Faculty $model): bool
    {
        return false;
    }
}
