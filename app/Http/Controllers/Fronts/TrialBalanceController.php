<?php

namespace App\Http\Controllers\Fronts;

use App\Models\Ledger;
use App\Models\ChartAccount;
use App\Models\TrialBalance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TrialBalanceController extends Controller
{
    public function trialBalanceList(Request $request){
        if ($request->ajax()) {

            $data = Ledger::with(['chartAccount']);

            $total_debit = $data->sum('debit_amount');

            $total_credit = $data->sum('credit_amount');

            return Datatables::of($data)
                                ->with('total_debit', $total_debit)
                                ->with('total_credit', $total_credit)
                                ->addIndexColumn()
                                ->editColumn('account_name', function($each) {
                                    return $each->chartAccount ? $each->chartAccount->name : $each->description;
                                })
                                ->rawColumns(['account_name'])
                                ->make(true);
        }
        return view('fronts.trial_balances.trial_balance_list');
    }

    public function trialBalanceAdd(){
        return view('fronts.trial_balances.trial_balance_add');
    }
}
