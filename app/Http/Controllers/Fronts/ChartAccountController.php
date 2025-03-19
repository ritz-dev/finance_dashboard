<?php

namespace App\Http\Controllers\Fronts;

use Illuminate\Support\Str;
use App\Models\ChartAccount;
use Illuminate\Http\Request;
use App\Models\AccountCategory;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ChartAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $account_categories = AccountCategory::get();
        return view('fronts.chart_accounts.add_chart_account',compact('account_categories'));
    }

    public function chartAccountAjax(Request $request)
    {

        if ($request->ajax()) {

            $data = ChartAccount::with(['accountCategory']);

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('account_category', function($each) {
                        return $each->accountCategory ? $each->accountCategory->account_category_name : '';
                    })
                    ->rawColumns(['account_category'])
                    ->make(true);
        }
        return view('fronts.chart_accounts.index');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:chart_accounts,code',
            'account_category_id' => 'required|exists:account_categories,id',
            'total_debit' => 'required|numeric',
            'total_credit' => 'required|numeric',
        ]);

        $account = new ChartAccount;
        $account->uuid = Str::uuid();
        $account->name = $validated['name'];
        $account->code = $validated['code'];
        $account->account_category_id = $validated['account_category_id'];
        $account->total_debit = $validated['total_debit'];
        $account->total_credit = $validated['total_credit'];
        $account->save();

        return view('fronts.chart_accounts.index');
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
