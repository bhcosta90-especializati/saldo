<?php

namespace App\Repositories;

use App\Models\Transaction;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class TransactionRepository.
 */
class TransactionRepository extends BaseRepository implements Contracts\TransactionContract
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Transaction::class;
    }

    public function getTransactions($obj, array $filters)
    {
        return $this->model
            ->orderBy('created_at', 'DESC')
            ->with(['transaction_to'])
            ->byUser($obj)
            ->byEmail($filters['email'] ?? null)
            ->byDate($filters['date'] ?? null)
            ->byType($filters['type'] ?? null)
            ->byUuid($filters['id'] ?? null)
            ->paginate(30);
    }
}
