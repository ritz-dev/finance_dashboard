<?php

namespace App\Http\Controllers\Fronts;

use App\Models\Ledger;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Ledger::with(['chartAccount','transaction']);

            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('date', function($each) {
                return $each->date ? date('d-M-Y H:i:s A', strtotime($each->date)) : '';
            })
            ->editColumn('name', function($each) {
                $chart_account_name = $each->chartAccount != null ? $each->chartAccount->name : '';
                return $chart_account_name;
            })
            ->editColumn('number', function($each) {
                $transaction_number = $each->transaction != null ? $each->transaction->number : '';
                return $transaction_number;
            })
            ->rawColumns(['date','name','number'])
            ->make(true);
        }
        return view('fronts/ledgers/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
