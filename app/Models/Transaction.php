<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * Get the parent imageable model (user or post).
     */
    public function transaction()
    {
        return $this->morphTo();
    }
}
