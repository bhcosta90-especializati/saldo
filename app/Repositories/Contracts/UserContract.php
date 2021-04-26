<?php

namespace App\Repositories\Contracts;

interface UserContract
{
    public function deposit(int $user, float $value);

    public function withdraw(int $user, float $value);

    public function balance(int $user);
}
