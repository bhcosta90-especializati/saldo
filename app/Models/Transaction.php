<?php

namespace App\Models;

use Costa\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'amount',
        'total_before',
        'total_after',
        'date',
        'type',
        'transaction_to_type',
        'transaction_to_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the parent imageable model (user or post).
     */
    public function transaction()
    {
        return $this->morphTo();
    }

    /**
     * Get the parent imageable model (user or post).
     */
    public function transaction_to()
    {
        return $this->morphTo();
    }

    public function type($type = null)
    {
        $types = [
            'I' => __('Entrada'),
            'O' => __('Saque'),
            'T' => __('Transferência'),
        ];

        if (empty($type)) {
            return $types;
        }

        if (!empty($this->transaction_to->id) && $type == 'I') {
            return 'Recebido';
        }

        return $types[$type];
    }

    public function scopeByEmail($q, $email)
    {
        if ($email) {
            $q->whereHas('transaction_to', function ($q) use ($email) {
                $q->where('email', $email);
            });
        }
    }

    public function scopeByDate($q, $date)
    {
        if ($date) {
            $q->where('date', $date);
        }
    }

    public function scopeByType($q, $type)
    {
        if ($type) {
            $q->where('type', $type);
        }
    }

    public function scopeByUuid($q, $uuid)
    {
        if ($uuid) {
            $q->where('uuid', $uuid);
        }
    }

    public function scopeByUser($q, $obj){
        return $q->where('transaction_id', $obj->id)->where('transaction_type', get_class($obj));
    }
}
