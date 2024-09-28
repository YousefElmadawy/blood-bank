<?php

namespace App\Repositories;
 

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;


class UserRepository implements  UserRepositoryInterface
{
    // public function __construct(User $user)
    // {
    //     parent::__construct($user);
    // }

    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById(User $user)
    {
        return $user;
    }

    public function createUser(array $attributes)
    {
        return User::create($attributes);
    }

    public function updateUser(User $user, array $attributes)
    {
        // dd($user);

        return $user->update($attributes);
    }

    public function deleteUser(User $user)
    {
        return $user->delete($user);
    }
}
