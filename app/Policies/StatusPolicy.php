<?php

namespace App\Policies;

use App\Models\status;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user, status $status)
    {
        return $user->id === $status->user_id;
//        return $user->id === $status->user->id;
    }
}
