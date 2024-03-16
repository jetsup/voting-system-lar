<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elections extends Model
{
    use HasFactory;

    protected $fillable = [
        "election_type",
        "county_id",
        "constituency_id",
        "start_date",
        "end_date",
        "election_status",
    ];
}
