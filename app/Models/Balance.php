<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $table = 'balance';

    /**
     * Get the parent imageable model (user or post).
     */
    public function balance()
    {
        return $this->morphTo();
    }
}
