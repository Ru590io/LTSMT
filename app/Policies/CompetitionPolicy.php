<?php

namespace App\Policies;

use App\Models\User;

class CompetitionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function assignAthlete(User $user) {
        return $user->role === 'Entrenador'; 
    }
}
