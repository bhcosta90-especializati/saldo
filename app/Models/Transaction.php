<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'total_before',
        'total_after',
        'date',
        'type',
        'transaction_to_type',
        'transaction_to_id',
    ];

    /**
     * Get the parent imageable model (user or post).
     */
    public function transaction()
    {
        return $this->morphTo();
    }

    public function deposit($value){
        dd($value);
    }
}
