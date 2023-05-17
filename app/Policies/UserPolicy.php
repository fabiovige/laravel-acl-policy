<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if(auth()->id() === User::ADMIN){
            return true;
        }
        return null;
    }

    public function destroy(User $user, User $model): Response
    {
        return $user->id === $model->user_id ? Response::allow() : Response::deny(__('You do not own this user'));
    }
}
