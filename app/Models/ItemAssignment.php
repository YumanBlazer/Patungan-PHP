<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemAssignment extends Model
{
    use HasFactory;

    protected $table = 'public.item_assignments';

    protected $fillable = [
        'item_id',
        'user_id',
        'quantity',
        'assigned_amount',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'assigned_amount' => 'decimal:2',
    ];

    // Relationships
    public function item()
    {
        return $this->belongsTo(BillItem::class, 'item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
