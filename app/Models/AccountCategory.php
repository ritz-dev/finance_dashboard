<?php

namespace App\Models;

use App\Models\AccountType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $tables = "account_categories";

    protected $fillable = [
        'uuid',
        'account_type_id',
        'account_category_name'
    ];

    public function accountType(){
        return $this->belongsTo(AccountType::class,'account_type_id','id');
    }
}
