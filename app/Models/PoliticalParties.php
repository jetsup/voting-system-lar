<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliticalParties extends Model
{
    use HasFactory;

    protected $fillable = [
        "party",
        "slogan",
        "party_leader",
        "party_image",
        "election_id",
    ];
}
