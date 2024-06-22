<?php

namespace App\Policies;

use App\Models\User;
use App\Models\College;
use Illuminate\Auth\Access\HandlesAuthorization;

class CollegePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the college can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list colleges');
    }

    /**
     * Determine whether the college can view the model.
     */
    public function view(User $user, College $model): bool
    {
        return $user->hasPermissionTo('view colleges');
    }

    /**
     * Determine whether the college can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create colleges');
    }

    /**
     * Determine whether the college can update the model.
     */
    public function update(User $user, College $model): bool
    {
        return $user->hasPermissionTo('update colleges');
    }

    /**
     * Determine whether the college can delete the model.
     */
    public function delete(User $user, College $model): bool
    {
        return $user->hasPermissionTo('delete colleges');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete colleges');
    }

    /**
     * Determine whether the college can restore the model.
     */
    public function restore(User $user, College $model): bool
    {
        return false;
    }

    /**
     * Determine whether the college can permanently delete the model.
     */
    public function forceDelete(User $user, College $model): bool
    {
        return false;
    }
}
