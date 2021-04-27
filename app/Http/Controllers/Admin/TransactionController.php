<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(TransactionService $service, Transaction $transaction, Request $request)
    {
        $data = $service->all($request->all());
        $form = $request->all();
        $types = $transaction->type();

        return view('admin.balance.transaction', compact('data', 'form', 'types'));
    }
}
