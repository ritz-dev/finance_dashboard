<?php

namespace App\Http\Controllers\Fronts;

use App\Models\Ledger;
use App\Models\Transaction;
use App\Models\ChartAccount;
use Illuminate\Http\Request;
use App\Models\JournalDetail;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard(){
        $chart_accounts_count = ChartAccount::count();
        $transactions_count = TransactionDetail::count();
        $journals_count = JournalDetail::count();
        $ledgers_count = Ledger::count();
        return view('fronts.dashboard',compact('chart_accounts_count','transactions_count','journals_count','ledgers_count'));
    }
}
