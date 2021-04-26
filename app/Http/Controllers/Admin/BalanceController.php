<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function index(Request $request){
        $balance = $request->user()->myBalance(true);
        
        return view('admin.balance.index', compact('balance'));
    }
}
