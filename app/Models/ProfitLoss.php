<?php

namespace App\Models;

use App\Models\ChartAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfitLoss extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "profit_losses";

    protected $fillable = [
        "chart_account_id",
        "account_type",
        "description",
        "total_debit",
        "total_credit",
        "total"
    ];

    public function chartAccount(){
        return $this->belongsTo(ChartAccount::class,'chart_account_id','id');
    }
}
