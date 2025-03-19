<?php

namespace App\Http\Controllers\Fronts;

use App\Models\ProfitLoss;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class BalanceSheetController extends Controller
{
    public function balanceSheetList(Request $request){
        return view('fronts.balance_sheets.balance_sheet_list');
    }

    public function balanceSheetAjax(Request $request){
        if ($request->ajax()) {

            $month = $request->month;
            $year = $request->year;

            // if ($request->filled('from_date') && $request->filled('to_date')) {
            //     $data = $data->whereBetween('created_at', [$request->from_date, $request->to_date]);
            // }


            $data = ProfitLoss::with('chartAccount')
                                ->where('total', '!=', 0)
                                ->whereMonth('created_at', $month)
                                ->whereYear('created_at', $year);

            $query = ProfitLoss::with('chartAccount')
                                ->where('total', '!=', 0)
                                ->whereMonth('created_at', $month)
                                ->whereYear('created_at', $year);

            $profitLosses = $query->where('account_type', 'LIKE', 'Revenue')->get();

            $saleTotal = 0;
            $notSaleTotal = 0;
            $revenueNetTotal = 0;

            foreach($profitLosses as $profitLoss){
                if($profitLoss->chartAccount->name == 'Sales'){
                    $saleTotal += $profitLoss->total;
                }else{
                    $notSaleTotal += $profitLoss->total;
                }
            }

            $revenueNetTotal = abs($saleTotal) - $notSaleTotal;

            $expenseProfitLosses = ProfitLoss::with('chartAccount')
                                                ->where('total', '!=', 0)
                                                ->whereMonth('created_at', $month)
                                                ->whereYear('created_at', $year)
                                                ->where('account_type', 'LIKE', 'Expense')
                                                ->get();

            $expenseNetTotal = 0;

            foreach($expenseProfitLosses as $expenseProfitLoss){
                $expenseNetTotal += $expenseProfitLoss->total;
            }

            if ($revenueNetTotal < $expenseNetTotal) {
                $retainEarning = -($revenueNetTotal + $expenseNetTotal);
            } else {
                $retainEarning = $revenueNetTotal - $expenseNetTotal;
            }

            // Balance Sheet
            // Asset

            $assetProfitLosses = ProfitLoss::with('chartAccount')
                                        ->where('total','!=',0)
                                        ->whereMonth('created_at',$month)
                                        ->whereYear('created_at',$year)
                                        ->where('account_type','LIKE','Asset')
                                        ->get();

            $assetNetTotal = 0;

            foreach($assetProfitLosses as $assetProfitLoss){
                $assetNetTotal += $assetProfitLoss->total;
            }

            // Liability

            $liaEquiProfitLosses = ProfitLoss::with('chartAccount')->where('account_type','LIKE','Liability')
                                        ->orwhere('account_type','LIKE','Equity')
                                        ->where('total','!=',0)
                                        ->whereMonth('created_at',$month)
                                        ->whereYear('created_at',$year)
                                        ->get();

            $liaEquiTotal = 0;
            $liaEquiNetTotal = 0;

            foreach($liaEquiProfitLosses as $liaEquiProfitLoss){
                $liaEquiTotal += $liaEquiProfitLoss->total;
            }

            $liaEquiNetTotal = abs($liaEquiTotal) + $retainEarning;

            return Datatables::of($data)
                                ->with('revenueNetTotal', $revenueNetTotal)
                                ->with('expenseNetTotal',$expenseNetTotal)
                                ->with('assetNetTotal',$assetNetTotal)
                                ->with('liaEquiNetTotal',$liaEquiNetTotal)
                                ->editColumn('account_name', function($each) {
                                    return $each->chartAccount ? $each->chartAccount->name : $each->description;
                                })
                                ->rawColumns(['account_name'])
                                ->make(true);
        }



        return view('fronts.balance_sheets.balance_sheet_list');


    }
}
