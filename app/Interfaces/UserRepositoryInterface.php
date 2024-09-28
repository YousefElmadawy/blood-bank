<?php 

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface {

    public function getAllUsers();
    public function getUserById(User $user);
    public function createUser(array $attributes);
    public function deleteUser(User $user);
    public function updateUser(User $user, array $attributes);
}