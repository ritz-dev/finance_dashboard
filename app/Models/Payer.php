<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payer extends Model
{
    protected $tables = "payers";

    protected $fillable = [
        "uuid",
        "name",
        "type",
        "contact_info"
    ];
}
