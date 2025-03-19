<?php

namespace App\Models;

use App\Models\JournalDetail;
use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "transactions";

    protected $fillable = [
        "uuid",
        "transaction_date",
        "description",
        "number",
        "reference_number",
        "created_by"
    ];

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function journalDetail()
    {
        return $this->hasMany(JournalDetail::class);
    }
}
