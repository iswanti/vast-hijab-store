<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'user_id',
    'invoice',
    'total',
    'status',
    'resi',
    'confirmed_at',
    'shipped_at',
    'completed_at',
    'cancelled_at'
];

    protected $casts = [
    'confirmed_at' => 'datetime',
    'shipped_at' => 'datetime',
    'completed_at' => 'datetime',
    'cancelled_at' => 'datetime',
    ];

    public function details()
    {
        return $this->hasMany(
            OrderDetail::class
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    public function notifications()
    {
    return $this->hasMany(
        Notification::class
    );
}
}