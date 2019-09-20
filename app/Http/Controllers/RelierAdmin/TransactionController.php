<?php

namespace App\Http\Controllers\RelierAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;

class TransactionController extends Controller
{
    public function viewTransactions(){
        $transactions=Transaction::where('id','<>','')->orderBy('id', 'desc')->get();
        return view('server.relier.transactions.view_transactions',compact('transactions'));
    }
}
