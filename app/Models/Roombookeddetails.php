<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roombookeddetails extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'houseid',
        'name',
        'mobileno',
        'address',
        'housename',
        'houseaddress',
        'maxdaycount',
        'amountpaid',
        'amount',
        'status',
        'proof',

    ];
}
