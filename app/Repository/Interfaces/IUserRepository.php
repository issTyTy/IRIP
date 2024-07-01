<?php

namespace App\Repository\Interfaces;

use App\DTO\UserDTO;

interface IUserRepository
{
    public function createUser(UserDTO $userDTO): bool;
}
