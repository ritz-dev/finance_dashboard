<?php

namespace App\Models;

use App\Models\Transaction;
use App\Models\ChartAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ledger extends Model
{
    use HasFactory;

    protected $table = "ledgers";
    protected $fillable = [
        "uuid",
        "date",
        "chart_account_id",
        "transaction_id",
        "description",
        "debit_amount",
        "credit_amount",
        "balance"
    ];

    public function chartAccount(){
        return $this->belongsTo(ChartAccount::class,'chart_account_id','id');
    }

    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id','id');
    }
}
