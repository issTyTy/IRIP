<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\DTO\UserDTO;
use App\Repository\UserRepository;
use App\Repository\Interfaces\IUserRepository;


class UserController extends Controller
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function create(UserRequest $UserRequest): void
    {

        $userDTO = UserDTO::from($UserRequest->all());
        $user = $this->userRepository->createUser($userDTO);
    }
}
