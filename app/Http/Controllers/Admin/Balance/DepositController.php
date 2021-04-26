<?php

namespace App\Http\Controllers\Admin\Balance;

use App\Form\Admin\DepositForm;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\UserService;
use Illuminate\Http\Request;
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
            'label' => __('Enviar')
        ]);

        return view('admin.balance.deposit.form', compact('form'));
    }

    public function store(FormBuilder $formBuilder, UserService $transaction)
    {
        $form = $formBuilder->create(DepositForm::class, [
            'method' => 'POST',
            'url' => route('admin.balance.deposit.store')
        ]);

        $form->redirectIfNotValid();

        $values = $form->getFieldValues();
        $transaction->deposit($values);
    }
}
