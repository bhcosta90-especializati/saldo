<?php

namespace App\Services;

use App\Repositories\Contracts\TransactionContract;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionService {
    public function __construct(
        private TransactionContract $transactionContract,
        private Request $request
    )
    {
        
    }

    public function all(array $data){
        return $this->transactionContract->getTransactions($this->request->user(), $data);
    }
}