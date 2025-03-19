<?php

namespace App\Models;

use App\Models\Payee;
use App\Models\Payer;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "payments";
    protected $fillable = [
        "uuid",
        "payment_date",
        "amount",
        "payee_id",
        "payee_method",
        "payer_id",
        "payer_method",
        "transaction_id",
        "description"
    ];

    public function payee(){
        return $this->belongsTo(Payee::class,'payee_id','id');
    }

    public function payer(){
        return $this->belongsTo(Payer::class,'payer_id','id');
    }

    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id','id');
    }
}
