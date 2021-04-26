<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $table = 'balance';

    protected $fillable = [
        'amount'
    ];

    /**
     * Get the parent imageable model (user or post).
     */
    public function balance()
    {
        return $this->morphTo();
    }

    public function deposit($value) {
        $this->amount = $this->amount + $value;
        return $this->save();
    }

    public function withdraw($value) {
        $this->amount = $this->amount - $value;
        return $this->save();
    }
}
