<?php

namespace App\Repositories;

use App\Models\User;
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

        $objUser->transactions()->create([
            'value' => $value
        ]);
    }

    public function withdraw(int $user, float $value) {
        $objUser = $this->getById($user);
        
        $objUser->transactions()->create([
            'value' => $value
        ]);
    }
}
