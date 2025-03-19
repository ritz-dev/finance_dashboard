<?php

namespace App\Models;

use App\Models\Transaction;
use App\Models\ChartAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDetail extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "transaction_details";

    protected $fillable = [
        "uuid",
        "transaction_id",
        "chart_account_id",
        "note",
        "debit",
        "credit"
    ];

    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id','id');
    }

    public function chartAccount(){
        return $this->belongsTo(ChartAccount::class,'chart_account_id','id');
    }
}
