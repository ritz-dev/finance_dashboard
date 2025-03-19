<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payee extends Model
{
    protected $tables = "payees";

    protected $fillable = [
        "uuid",
        "name",
        "type",
        "contact_info"
    ];
}
