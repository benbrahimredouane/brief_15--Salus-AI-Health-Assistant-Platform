<?php

namespace App\Policies;

use App\Models\Symptom;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SymptomPolicy
{


    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Symptom $symptom)
    {

        return $user->id === $symptom->user_id ? Response::allow() : Response::deny('you do not own this symptom!');
    }

    public function modify(User $user, Symptom $symptom): Response
    {
        return $user->id === $symptom->user_id
            ? Response::allow()
            : Response::deny('You do not own this habit.');
    }

    public function destroy(User $user, Symptom $symptom): Response
    {
        return $user->id === $symptom->user_id
            ? Response::allow()
            : Response::deny('You do not own this habit.');
    }
}
