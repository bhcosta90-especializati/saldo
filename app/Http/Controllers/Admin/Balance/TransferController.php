<?php

namespace App\Http\Controllers\Admin\Balance;

use App\Form\Admin\Transfer\SearchForm;
use App\Form\Admin\Transfer\TransferForm;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kris\LaravelFormBuilder\FormBuilder;

class TransferController extends Controller
{
    public function index(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(SearchForm::class, [
            'method' => 'GET',
            'url' => route('admin.balance.transfer.search')
        ])->add('btn', 'submit', [
            "attr" => ['class' => 'btn btn-primary'],
            'label' => __('Pŕoxima etapa')
        ]);

        return view('admin.balance.transfer.form', compact('form'));
    }

    public function create(FormBuilder $formBuilder, UserService $userService, $id)
    {
        $balance = $userService->balance();

        $form = $formBuilder->create(TransferForm::class, [
            'method' => 'POST',
            'url' => route('admin.balance.transfer.create.post', $id),
            'data' => [
                'balance' => $balance,
            ],
        ])->add('btn', 'submit', [
            "attr" => ['class' => 'btn btn-primary'],
            'label' => __('Transferir')
        ]);

        $user = $userService->getByUuid($id);

        return view('admin.balance.transfer.create', compact('form', 'user', 'balance'));
    }

    public function search(UserService $userService, Request $request){
        $data = $userService->search((string) $request->name, (string) $request->name);
        return view('admin.balance.transfer.search', compact('data'));
    }

    public function createPost(FormBuilder $formBuilder, UserService $userService, $id)
    {
        $balance = $userService->balance();
        
        $form = $formBuilder->create(TransferForm::class, [
            'data' => [
                'balance' => $balance,
            ]
        ]);

        $form->redirectIfNotValid();

        $values = $form->getFieldValues() + ['user_to' => $id];
        try {
            $userService->transfer($values);
            return redirect()->route('admin.balance.index')->with('success', __('Transferência realizada com sucesso'));
        } catch (Exception $e) {
            if ($e->getCode() == Response::HTTP_BAD_REQUEST) {
                return redirect()->back()->withInput($values)->with('error', $e->getMessage());
            }
            throw $e;
        }
    }
}
