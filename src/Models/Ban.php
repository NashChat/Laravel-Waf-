<?php

namespace Albert\Waf\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    use HasFactory;

    protected $table = 'waf_bans';

    protected $casts = [
        'banned_until' => 'datetime',
    ];
}
