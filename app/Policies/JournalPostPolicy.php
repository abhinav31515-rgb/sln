<?php

namespace App\Policies;

use App\Models\JournalPost;
use App\Models\User;

class JournalPostPolicy
{
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, JournalPost $journalPost): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, JournalPost $journalPost): bool
    {
        return $user->isAdmin();
    }
}
