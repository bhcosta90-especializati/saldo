<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Http\Response;
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
                throw new Exception(__('Aconteceu um problema no depósito'), Response::HTTP_BAD_REQUEST);
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

            if ($totalBefore < $value) {
                throw new Exception(__('Saldo insuficiente.'), Response::HTTP_BAD_REQUEST);
            }

            $objBalance = $objUser->balance()->firstOrCreate();
            if (!$objBalance->withdraw($value)) {
                throw new Exception(__('Aconteceu um problema no saque'), Response::HTTP_BAD_REQUEST);
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

    public function search(int $userLoging, array $data){
        $result = $this->model->where('id', '!=', $userLoging)->where(function($q) use($data){
            $q->where(function($q) use($data){
                $q->byName($data['name']);
            })->orWhere(function($q) use($data){
                $q->byEmail($data['name']);
            });
        });

        return $result->get();
    }

    public function transfer(int $user, int $userTo, float $value){
        try {
            $objUser = $this->getById($user);
            $objUserTo = $this->getById($userTo);

            $totalBefore = $objUser->myBalance();
            $totalBeforeTo = $objUserTo->myBalance();

            if ($totalBefore < $value) {
                throw new Exception(__('Saldo insuficiente.'), Response::HTTP_BAD_REQUEST);
            }

            $objBalance = $objUser->balance()->firstOrCreate();
            if (!$objBalance->withdraw($value)) {
                throw new Exception(__('Aconteceu um problema no saque'), Response::HTTP_BAD_REQUEST);
            }

            $objBalanceTo = $objUserTo->balance()->firstOrCreate();
            if (!$objBalanceTo->deposit($value)) {
                throw new Exception(__('Aconteceu um problema no depósito'), Response::HTTP_BAD_REQUEST);
            }

            $objUser->transactions()->create([
                'amount' => $value,
                'total_before' => (float) $totalBefore,
                'total_after' => (float) ($totalBefore - $value),
                'transaction_to_type' => get_class($objUserTo),
                'transaction_to_id' => $objUserTo->id,
                'date' => Carbon::now(),
                'type' => 'T'
            ]);

            $objUserTo->transactions()->create([
                'amount' => $value,
                'total_before' => (float) $totalBeforeTo,
                'total_after' => (float) ($totalBeforeTo + $value),
                'transaction_to_type' => get_class($objUser),
                'transaction_to_id' => $objUser->id,
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

    public function balance($user)
    {
        $objUser = $this->getById($user);
        return $objUser->myBalance(true);
    }

    public function getByUuid(string $uuid){
        return $this->model->where('uuid', $uuid)->first();
    }
}
