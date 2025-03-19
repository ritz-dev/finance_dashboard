<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Fronts\LedgerController;
use App\Http\Controllers\Fronts\JournalController;
use App\Http\Controllers\Fronts\DashboardController;
use App\Http\Controllers\Fronts\TransactionController;
use App\Http\Controllers\Fronts\BalanceSheetController;
use App\Http\Controllers\Fronts\ChartAccountController;
use App\Http\Controllers\Fronts\TrialBalanceController;


// Route::get('/', function () {
//     return "Hello World";
// });


Route::get('/',[DashboardController::class,'dashboard'])->name('dashboard');

Route::post('/tran_store', [TransactionController::class, 'store']);

Route::resource('/transactions',TransactionController::class);

Route::get('/account-list',[ChartAccountController::class,'chartAccountAjax'])->name('account-list');

Route::post('/journal_store', [JournalController::class, 'store']);

Route::resource('/journals',JournalController::class);

Route::resource('/ledgers',LedgerController::class);

Route::post('/chart_store', [ChartAccountController::class, 'store']);

Route::resource('/chart_accounts',ChartAccountController::class);

Route::get('/trial_balance_list',[TrialBalanceController::class,'trialBalanceList'])->name('trial_balance_list');

Route::get('/trial_balance_add',[TrialBalanceController::class,'trialBalanceAdd'])->name('trial_balance_add');

Route::get('/balance_sheet_list',[BalanceSheetController::class,'balanceSheetList'])->name('balance_sheet_list');

Route::get('/balance_sheet_ajax',[BalanceSheetController::class,'balanceSheetAjax'])->name('balance_sheet_ajax');

