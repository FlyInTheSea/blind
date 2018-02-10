<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BasePolicy
{
    use HandlesAuthorization;

    public function action_is_in_mine_allowed_list(User $user)
    {
        //
//        var_dump($user->role);
        return true;
    }
}
