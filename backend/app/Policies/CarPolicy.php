<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Car;
use App\Models\User;

class CarPolicy
{
    public function create(User $user): bool
    {
        return !is_null($user);
    }

    public function update(User $user, Car $car): bool
    {
        return $user->id === $car->user_id;
    }

    public function delete(User $user, Car $car): bool
    {
        return $user->id === $car->user_id;
    }
}
