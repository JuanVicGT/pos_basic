<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    private const MODEL_NAME = 'user';

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return $user->admin || $user->hasPermissionTo('can_' . self::MODEL_NAME);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        //
        return $user->admin || $user->hasPermissionTo('can_' . self::MODEL_NAME);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->admin || $user->hasPermissionTo('can_' . self::MODEL_NAME);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        //
        return $user->admin || $user->hasPermissionTo('can_' . self::MODEL_NAME);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        //
        return $user->admin || $user->hasPermissionTo('can_' . self::MODEL_NAME);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        //
        return false;
    }
}
