<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function index(Request $request, UserService $userService){
        $balance = $userService->balance();
        return view('admin.balance.index', compact('balance'));
    }
}
