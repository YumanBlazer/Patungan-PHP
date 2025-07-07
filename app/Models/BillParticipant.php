<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillParticipant extends Model
{
    use HasFactory;

    protected $table = 'public.bill_participants';

    protected $fillable = [
        'bill_id',
        'user_id',
        'share_amount',
        'share_percentage',
        'status',
        'joined_at',
    ];

    protected $casts = [
        'share_amount' => 'decimal:2',
        'share_percentage' => 'decimal:2',
        'joined_at' => 'datetime',
    ];

    // Relationships
    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scopes
    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}