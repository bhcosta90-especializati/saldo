<?php

namespace App\Repositories\Contracts;

interface UserContract
{
    public function deposit(int $user, float $value);

    public function withdraw(int $user, float $value);

    public function balance(int $user);

    public function transfer(int $user, int $userTo, float $value);

    public function search(int $userLoging, array $data);

    public function getByUuid(string $uuid);
}
