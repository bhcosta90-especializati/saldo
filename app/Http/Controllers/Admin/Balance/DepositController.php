<?php

namespace App\Http\Controllers\Admin\Balance;

use App\Form\Admin\DepositForm;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\FormBuilder;

class DepositController extends Controller
{
    public function index(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(DepositForm::class, [
            'method' => 'POST',
            'url' => route('admin.balance.deposit.store')
        ])->add('btn', 'submit', [
            "attr" => ['class' => 'btn btn-primary'],
            'label' => __('Depositar')
        ]);

        return view('admin.balance.deposit.form', compact('form'));
    }

    public function store(FormBuilder $formBuilder, UserService $userService)
    {
        $form = $formBuilder->create(DepositForm::class, [
            'method' => 'POST',
            'url' => route('admin.balance.deposit.store')
        ]);

        $form->redirectIfNotValid();

        $values = $form->getFieldValues();
        try {
            $userService->deposit($values);
            return redirect()->route('admin.balance.index')->with('success', __('Saque realizado com sucesso'));
        } catch (Exception $e) {
            if ($e->getCode() == Response::HTTP_BAD_REQUEST) {
                return redirect()->back()->withInput($values)->with('error', $e->getMessage());
            }
            throw $e;
        }
    }
}
