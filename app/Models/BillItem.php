<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillItem extends Model
{
    use HasFactory;

    protected $table = 'public.bill_items';

    protected $fillable = [
        'bill_id',
        'name',
        'description',
        'quantity',
        'unit_price',
        'total_price',
        'category',
        'metadata',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'metadata' => 'array',
    ];

    // Relationships
    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id');
    }

    public function assignments()
    {
        return $this->hasMany(ItemAssignment::class, 'item_id');
    }

    // Helper methods
    public function getAssignedUsersAttribute()
    {
        return $this->assignments()->with('user')->get()->pluck('user');
    }

    public function getTotalAssignedAttribute()
    {
        return $this->assignments()->sum('quantity');
    }

    public function isFullyAssigned()
    {
        return $this->total_assigned >= $this->quantity;
    }
}