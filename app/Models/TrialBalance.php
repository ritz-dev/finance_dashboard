<?php

namespace App\Models;

use App\Models\ChartAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrialBalance extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "trial_balances";

    protected $fillable = [
        "uuid",
        "chart_account_id",
        "debit",
        "credit"
    ];

    public function chartAccount(){
        return $this->belongsTo(ChartAccount::class,'chart_account_id','id');
    }
}
