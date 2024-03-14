<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guestrooms extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email',
        'address',
        'district',
        'mobileno',
        'housename',
        'roomcount',
        'minperiod',
        'maxperiod',
        'rentperday',
        'photos',
    ];
}
