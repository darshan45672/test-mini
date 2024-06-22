<?php

namespace App\Policies;

use App\Models\HoD;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HoDPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the hoD can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list hods');
    }

    /**
     * Determine whether the hoD can view the model.
     */
    public function view(User $user, HoD $model): bool
    {
        return $user->hasPermissionTo('view hods');
    }

    /**
     * Determine whether the hoD can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create hods');
    }

    /**
     * Determine whether the hoD can update the model.
     */
    public function update(User $user, HoD $model): bool
    {
        return $user->hasPermissionTo('update hods');
    }

    /**
     * Determine whether the hoD can delete the model.
     */
    public function delete(User $user, HoD $model): bool
    {
        return $user->hasPermissionTo('delete hods');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete hods');
    }

    /**
     * Determine whether the hoD can restore the model.
     */
    public function restore(User $user, HoD $model): bool
    {
        return false;
    }

    /**
     * Determine whether the hoD can permanently delete the model.
     */
    public function forceDelete(User $user, HoD $model): bool
    {
        return false;
    }
}
