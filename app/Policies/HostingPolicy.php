<?php

namespace App\Policies;

use App\Models\Hosting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HostingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('hosting.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Hosting  $hosting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Hosting $hosting)
    {
        return $user->can('hosting.index');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('hosting.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Hosting  $hosting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Hosting $hosting)
    {
        return $hosting->deleted_at === null
            && $user->can('hosting.update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Hosting  $hosting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Hosting $hosting)
    {
        return $hosting->deleted_at !== null
            && $user->can('hosting.delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Hosting  $hosting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Hosting $hosting)
    {
        return $hosting->deleted_at !== null
            && $user->can('teams.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Hosting  $hosting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Hosting $hosting)
    {
        return $hosting->deleted_at !== null
            && $user->can('hosting.delete');
    }
}
