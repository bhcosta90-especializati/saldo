<?php

namespace App\Http\Controllers\Admin\Balance;

use App\Form\Admin\WithdrawForm;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kris\LaravelFormBuilder\FormBuilder;

class WithdrawController extends Controller
{
    public function index(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(WithdrawForm::class, [
            'method' => 'POST',
            'url' => route('admin.balance.withdraw.store')
        ])->add('btn', 'submit', [
            "attr" => ['class' => 'btn btn-primary'],
            'label' => __('Sacar')
        ]);

        return view('admin.balance.withdraw.form', compact('form'));
    }

    public function store(FormBuilder $formBuilder, UserService $userService)
    {
        $form = $formBuilder->create(WithdrawForm::class, [
            'method' => 'POST',
            'url' => route('admin.balance.withdraw.store')
        ]);

        $form->redirectIfNotValid();

        $values = $form->getFieldValues();
        try {
            $userService->withdraw($values);
            return redirect()->route('admin.balance.index')->with('success', __('Saque realizado com sucesso'));
        } catch (Exception $e) {
            if ($e->getCode() == Response::HTTP_BAD_REQUEST) {
                return redirect()->back()->withInput($values)->with('error', $e->getMessage());
            }
            throw $e;
        }
    }
}
