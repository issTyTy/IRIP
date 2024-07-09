<?php

namespace App\DTO;
use Spatie\LaravelData\Data;
use Illuminate\Support\Facades\Hash;

class UserDTO extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    )
    {}
}
