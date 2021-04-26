<?php

namespace App\Services;

use App\Repositories\Contracts\UserContract;
use Illuminate\Http\Request;

class UserService {
    public function __construct(
        private UserContract $userContract,
        private Request $request
    )
    {
        // 
    }

    public function deposit(array $data){
        $this->userContract->deposit($this->request->user()->id, $data['value']);
    }
    
    public function withdraw(array $data){
        $this->userContract->withdraw($this->request->user()->id, $data['value']);
    }
}