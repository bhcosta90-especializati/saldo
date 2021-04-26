<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository implements Contracts\UserContract
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }

    public function deposit(int $user, float $value) {
        $objUser = $this->getById($user);
        $objBalance = $objUser->balance()->firstOrCreate();
        if(!$objBalance->deposit($value)){
            throw new Exception(__('Aconteceu um problema no depósito'));
        }
    }

    public function withdraw(int $user, float $value) {
        $objUser = $this->getById($user);
        $objBalance = $objUser->balance()->firstOrCreate();
        if(!$objBalance->withdraw($value)){
            throw new Exception(__('Aconteceu um problema no saque'));
        }
    }
}
