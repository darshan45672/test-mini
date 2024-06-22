<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ActivityType;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the activityType can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list activitytypes');
    }

    /**
     * Determine whether the activityType can view the model.
     */
    public function view(User $user, ActivityType $model): bool
    {
        return $user->hasPermissionTo('view activitytypes');
    }

    /**
     * Determine whether the activityType can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create activitytypes');
    }

    /**
     * Determine whether the activityType can update the model.
     */
    public function update(User $user, ActivityType $model): bool
    {
        return $user->hasPermissionTo('update activitytypes');
    }

    /**
     * Determine whether the activityType can delete the model.
     */
    public function delete(User $user, ActivityType $model): bool
    {
        return $user->hasPermissionTo('delete activitytypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete activitytypes');
    }

    /**
     * Determine whether the activityType can restore the model.
     */
    public function restore(User $user, ActivityType $model): bool
    {
        return false;
    }

    /**
     * Determine whether the activityType can permanently delete the model.
     */
    public function forceDelete(User $user, ActivityType $model): bool
    {
        return false;
    }
}
