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
}
