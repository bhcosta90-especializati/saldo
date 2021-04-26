<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
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

    public function deposit(int $user, float $value)
    {
        DB::beginTransaction();
        try {
            $objUser = $this->getById($user);
            $totalBefore = $objUser->myBalance();

            $objBalance = $objUser->balance()->firstOrCreate();
            if (!$objBalance->deposit($value)) {
                throw new Exception(__('Aconteceu um problema no depósito'));
            }

            $objUser->transactions()->create([
                'amount' => $value,
                'total_before' => (float) $totalBefore,
                'total_after' => (float) ($totalBefore + $value),
                'date' => Carbon::now(),
                'type' => 'I'
            ]);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function withdraw(int $user, float $value)
    {
        try {
            $objUser = $this->getById($user);
            $totalBefore = $objUser->myBalance();

            $objBalance = $objUser->balance()->firstOrCreate();
            if (!$objBalance->withdraw($value)) {
                throw new Exception(__('Aconteceu um problema no saque'));
            }

            $objUser->transactions()->create([
                'amount' => $value,
                'total_before' => (float) $totalBefore,
                'total_after' => (float) ($totalBefore - $value),
                'date' => Carbon::now(),
                'type' => 'O'
            ]);
            
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function balance($user)
    {
        $objUser = $this->getById($user);
        return $objUser->myBalance(true);
    }
}
