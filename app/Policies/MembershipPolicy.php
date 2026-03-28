<?php

namespace App\Policies;

use App\Models\Membership;
use App\Models\User;

class MembershipPolicy
{
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Membership $membership): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Membership $membership): bool
    {
        return $user->isAdmin();
    }
}
