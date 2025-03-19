<?php

namespace App\Models;

use App\Models\JournalDetail;
use App\Models\AccountCategory;
use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChartAccount extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "chart_accounts";
    protected $fillable = [
        "uuid",
        "name",
        "code",
        "account_category_id",
        "total_debit",
        "total_credit",
        "description"
    ];

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function journalDetail()
    {
        return $this->hasMany(JournalDetail::class);
    }

    public function accountCategory(){
        return $this->belongsTo(AccountCategory::class,'account_category_id','id');
    }
}
