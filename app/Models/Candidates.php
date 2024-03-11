<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidates extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "vie_position_id",
        "party_id",
        "affidavit",
        "total_votes",
    ];
}
