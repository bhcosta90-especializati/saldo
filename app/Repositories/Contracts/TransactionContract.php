<?php

namespace App\Repositories\Contracts;

interface TransactionContract
{
    public function getTransactions($obj, array $filters);
}
