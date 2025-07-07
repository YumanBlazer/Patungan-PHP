<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'public.bills';

    protected $fillable = [
        'title',
        'description',
        'total_amount',
        'currency',
        'bill_date',
        'created_by',
        'category',
        'tax_amount',
        'tip_amount',
        'discount_amount',
        'receipt_image_url',
        'status',
        'split_method',
        'metadata',
    ];

    protected $casts = [
        'bill_date' => 'datetime',
        'total_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'tip_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(BillItem::class, 'bill_id');
    }

    public function participants()
    {
        return $this->hasMany(BillParticipant::class, 'bill_id');
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class, 'bill_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeInDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('bill_date', [$startDate, $endDate]);
    }

    // Helper methods
    public function getFinalAmountAttribute()
    {
        return $this->total_amount + $this->tax_amount + $this->tip_amount - $this->discount_amount;
    }

    public function getParticipantCountAttribute()
    {
        return $this->participants()->count();
    }

    public function isSettled()
    {
        return $this->settlements()
            ->where('status', 'pending')
            ->count() === 0;
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'draft' => ['class' => 'bg-gray-100 text-gray-800', 'text' => 'Draft'],
            'active' => ['class' => 'bg-blue-100 text-blue-800', 'text' => 'Active'],
            'settled' => ['class' => 'bg-green-100 text-green-800', 'text' => 'Settled'],
            'cancelled' => ['class' => 'bg-red-100 text-red-800', 'text' => 'Cancelled'],
            default => ['class' => 'bg-gray-100 text-gray-800', 'text' => 'Unknown'],
        };
    }
}