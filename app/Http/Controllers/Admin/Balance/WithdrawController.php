<?php

namespace App\Http\Controllers\Admin\Balance;

use App\Form\Admin\DepositForm;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class WithdrawController extends Controller
{
    public function index(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(DepositForm::class, [
            'method' => 'POST',
            'url' => route('admin.balance.withdraw.store')
        ])->add('btn', 'submit', [
            "attr" => ['class' => 'btn btn-primary'],
            'label' => __('Enviar')
        ]);

        return view('admin.balance.withdraw.form', compact('form'));
    }

    public function store(FormBuilder $formBuilder, UserService $transaction)
    {
        $form = $formBuilder->create(DepositForm::class, [
            'method' => 'POST',
            'url' => route('admin.balance.withdraw.store')
        ]);

        $form->redirectIfNotValid();

        $values = $form->getFieldValues();
        $transaction->withdraw($values);

        return redirect()->route('admin.balance.index')->with('success', __('Saque realizado com sucesso'));
    }
}
