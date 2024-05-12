<?php

namespace App\Policies;

use App\Models\User;
use App\Models\weeklyshedule;
use Illuminate\Auth\Access\Response;

class WeeklyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, weeklyshedule $weeklyshedule): bool
    {
       // return $user->id === $weeklyshedule->user->id;
       return optional($weeklyshedule->user)->id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, weeklyshedule $weeklyshedule): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, weeklyshedule $weeklyshedule): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, weeklyshedule $weeklyshedule): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, weeklyshedule $weeklyshedule): bool
    {
        //
    }
}
