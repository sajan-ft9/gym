<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'member_id',  
        'paid_amount',
        'remaining_amount',
        'payment_date',
        'remarks'
    ];

    public function member(){
        return $this->belongsTo(Member::class);
    }
}
