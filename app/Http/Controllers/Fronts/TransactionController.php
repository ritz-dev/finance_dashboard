<?php

namespace App\Http\Controllers\Fronts;

use Exception;
use App\Models\Ledger;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\ChartAccount;
use App\Models\TrialBalance;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Transaction::where('number','LIKE','Tr-'.'%')->with(['transactionDetail','journalDetail']);

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('transaction_date', function($each) {
                        return $each->transaction_date ? date('d-M-Y H:i:s A', strtotime($each->transaction_date)) : '';
                    })
                    ->editColumn('account_name', function($each) {
                        if ($each->transactionDetail || $each->journalDetail) {

                            $tran_accounts = $each->transactionDetail
                                ? $each->transactionDetail->map(function($detail) {
                                    return $detail->chartAccount->name ?? '';
                                })->join('<br>')
                                : '';

                            // Get account names from JournalDetail
                            $jour_accounts = $each->journalDetail
                                ? $each->journalDetail->map(function($detail) {
                                    return $detail->chartAccount->name ?? '';
                                })->join('<br>')
                                : '';

                            return $tran_accounts . ($tran_accounts && $jour_accounts ? ', ' : '') . $jour_accounts;
                            }
                        })
                    ->editColumn('debit', function($each) {
                        if($each->transactionDetail || $each->journalDetail){
                            $tranDetail = $each->transactionDetail->pluck('debit')->implode('<br>');
                            $jourDetail = $each->journalDetail->pluck('debit')->implode('<br>');
                            return $tranDetail.$jourDetail;
                        }
                    })
                    ->editColumn('credit', function($each) {
                        if($each->transactionDetail || $each->journalDetail){
                            $tranDetail = $each->transactionDetail->pluck('credit')->implode('<br>');
                            $jourDetail = $each->journalDetail->pluck('credit')->implode('<br>');
                            return $tranDetail . $jourDetail;
                        }

                    })
                    // ->addColumn('action', function($row){

                    //         $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    //         return $btn;
                    // })
                    ->rawColumns(['transaction_date','account_name','debit','credit'])
                    ->make(true);
        }
        return view('fronts/transactions/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $chart_accounts = ChartAccount::get();
        return view('fronts.transactions.add_transaction',compact('chart_accounts'));
    }

    public function numberGenerate($start,$count,$digit){
        for($n = $start;$n < $start+$count; $n++){
            $number = str_pad($start,$digit,"0",STR_PAD_LEFT);
        }

        return $number;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_date' => "required",
            'created_by' => "required",
            'chart_account_id' => "required|exists:chart_accounts,id",
            'debit.*' => "required|numeric",
            'credit.*' => "required|numeric"
        ]);

        DB::beginTransaction();

        session()->forget('balance');

        try {
            $uuid = Str::uuid();

            if(Transaction::exists()){
                $transaction_no = Transaction::latest('id')->pluck('number');
                $filteredTransactions = $transaction_no->filter(function ($value) {
                    return str_starts_with($value, 'Tr');
                })->first();

                $transaction_ref_no = (int)substr($filteredTransactions, 3) + 1;

            }else{
                $transaction_ref_no = 1;
            }

            $transaction = Transaction::create([
                'uuid' => $uuid,
                'transaction_date' => $validated['transaction_date'],
                'description' => $request->description,
                'reference_number' => $request->reference_number,
                'created_by' => $validated['created_by'],
            ]);

            $transaction->number = "Tr-" . $this->numberGenerate($transaction_ref_no, 1, 8);

            $transaction->save();

            $chart_account_ids = $request->input('chart_account_id');
            $notes = $request->input('note');
            $debits = $request->input('debit');
            $credits = $request->input('credit');

            $transactions = [];
            $ledgers = [];
            $trial_balances = [];

            $ledger_balance = Ledger::latest('id')->pluck('balance')->first() ?? 0;

            session()->put('balance',$ledger_balance);

            foreach ($chart_account_ids as $index => $chart_account_id) {

                $transactions[] = [
                    'uuid' => $uuid,
                    'transaction_id' => $transaction->id,
                    'chart_account_id' => $chart_account_id,
                    'note' => $notes[$index] ?? null,
                    'debit' => $debits[$index] ?? 0,
                    'credit' => $credits[$index] ?? 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $balance = ($debits[$index] ?? 0) != 0
                    ? session()->get('balance') - $debits[$index]
                    : session()->get('balance') + $credits[$index];

                session()->put('balance',$balance);


                $ledgers[] = [
                    'uuid' => $uuid,
                    'date' => $transaction->transaction_date,
                    'chart_account_id' => $chart_account_id,
                    'transaction_id' => $transaction->id,
                    'description' => $transaction->description,
                    'debit_amount' => $debits[$index] ?? 0,
                    'credit_amount' => $credits[$index] ?? 0,
                    'balance' => session()->get('balance'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $trial_balances[] = [
                    'uuid' => $uuid,
                    'chart_account_id' => $chart_account_id,
                    'debit' => $debits[$index] ?? 0,
                    'credit' => $credits[$index] ?? 0,
                ];

                ChartAccount::where('id',$chart_account_id)->increment('total_debit', $debits[$index]);
                ChartAccount::where('id',$chart_account_id)->decrement('total_credit', $credits[$index]);

            }


            TransactionDetail::insert($transactions);
            Ledger::insert($ledgers);
            TrialBalance::insert($trial_balances);

            $trial_balance_credit = 0;
            $trial_balance_debit = 0;

            foreach($trial_balances as $trial){
                $trial_balance_credit += $trial['credit'];
                $trial_balance_debit += $trial['debit'];
            }

            $payment = new Payment;
            $payment->uuid = $uuid;
            $payment->payment_date = now();
            $payment->amount = 10000.00;
            $payment->payee_id = 1;
            $payment->payee_method = "Cash";
            $payment->payer_id = 1;
            $payment->payer_method = "Cash";
            $payment->transaction_id = $transaction->id;
            $payment->description = "testing";
            $payment->save();

            if($trial_balance_credit == $trial_balance_debit){
                DB::commit();

                // return redirect()->route('transactions.index')->with('success','Created Successfully.');
                return view('fronts/transactions/index');
            }else{
                DB::rollBack();
                return view('fronts/transactions/index');
                // return redirect()->route('transactions.index')->with('warning','Trial Balance does not match.');
            }

        }catch (Exception $e) {

            Log::error('Transaction creation failed: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to create transaction', 'error' => $e->getMessage()], 500);
        }
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
