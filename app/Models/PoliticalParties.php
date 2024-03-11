<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliticalParties extends Model
{
    use HasFactory;

    protected $fillable = [
        "party",
        "party_leader_id",
        "party_image",
    ];
}
