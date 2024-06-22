<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Activity;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the activity can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list activities');
    }

    /**
     * Determine whether the activity can view the model.
     */
    public function view(User $user, Activity $model): bool
    {
        return $user->hasPermissionTo('view activities');
    }

    /**
     * Determine whether the activity can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create activities');
    }

    /**
     * Determine whether the activity can update the model.
     */
    public function update(User $user, Activity $model): bool
    {
        return $user->hasPermissionTo('update activities');
    }

    /**
     * Determine whether the activity can delete the model.
     */
    public function delete(User $user, Activity $model): bool
    {
        return $user->hasPermissionTo('delete activities');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete activities');
    }

    /**
     * Determine whether the activity can restore the model.
     */
    public function restore(User $user, Activity $model): bool
    {
        return false;
    }

    /**
     * Determine whether the activity can permanently delete the model.
     */
    public function forceDelete(User $user, Activity $model): bool
    {
        return false;
    }
}
