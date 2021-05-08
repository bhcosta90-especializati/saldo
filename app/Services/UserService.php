<?php

namespace App\Services;

use App\Repositories\Contracts\UserContract;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function __construct(
        private UserContract $userContract,
        private Request $request
    ) {
        // 
    }

    public function deposit(array $data)
    {
        DB::beginTransaction();
        try {
            $this->userContract->deposit($this->request->user()->id, $data['value']);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function withdraw(array $data)
    {
        DB::beginTransaction();
        try {
            $this->userContract->withdraw($this->request->user()->id, $data['value']);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function transfer(array $data)
    {
        if ($this->request->user()->uuid == $data['user_to']) {
            throw new Exception(
                __('Não pode realizar uma transferência para sua própria conta'),
                Response::HTTP_BAD_REQUEST
            );
        }

        $objUser = $this->getByUuid($data['user_to']);

        DB::beginTransaction();
        try {
            $this->userContract->transfer($this->request->user()->id, $objUser->id, $data['value']);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function balance()
    {
        return $this->userContract->balance($this->request->user()->id);
    }

    public function search(string $name, string $email)
    {
        return $this->userContract->search($this->request->user()->id, [
            'name' => $name,
            'email' => $email,
        ]);
    }

    public function getByUuid(string $uuid)
    {
        return $this->userContract->getByUuid($uuid);
    }
}
