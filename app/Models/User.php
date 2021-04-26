<?php

namespace App\Models;

use Costa\LaravelUuid\Uuids;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the post's image.
     */
    public function balance()
    {
        return $this->morphOne(Balance::class, 'balance');
    }

    /**
     * Get the post's image.
     */
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transaction');
    }

    public function scopeMyBalance($b, $formated = false): float|string
    {
        $ret = (float) $b->where('users.id', $this->id)
            ->select(['balance.amount'])
            ->join('balance', 'users.id', '=', 'balance.balance_id')
            ->where('balance.balance_type', User::class)
            ->first()?->amount;

        if ($formated == true) {
            $ret = number_format($ret, 2, ',', '.');
        }

        return $ret;
    }
}
