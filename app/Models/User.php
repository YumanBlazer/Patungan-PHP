<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens; // Install Sanctum later for API authentication

class User extends Authenticatable
{
    use HasFactory, Notifiable; // HasApiTokens added later when Sanctum is installed

    // UUID Configuration
    public $incrementing = false;
    protected $keyType = 'string';

    // DATABASE CONFIGURATION STATUS:
    // ✅ Frontend pages: Modern, responsive design implemented
    // ⚠️  Database: Currently configured for development (see .env file)
    // 
    // PRODUCTION DEPLOYMENT CHECKLIST:
    // 1. Update .env with real Supabase credentials 
    // 2. Change $table to 'auth.users' for Supabase integration
    // 3. Run migrations and test authentication flow
    // 4. Verify Supabase RLS policies are configured
    //
    // For now using standard 'users' table for local development
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'phone',
        'password',
        'raw_user_meta_data',
        'raw_app_meta_data',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'raw_user_meta_data' => 'array',
            'raw_app_meta_data' => 'array',
        ];
    }

    /**
     * Accessor untuk full_name dari metadata
     */
    public function getFullNameAttribute()
    {
        // Cek di metadata dulu, kalau gak ada pakai name field
        if (isset($this->raw_user_meta_data['full_name'])) {
            return $this->raw_user_meta_data['full_name'];
        }
        
        return $this->name;
    }

    /**
     * Accessor untuk username dari metadata
     */
    public function getUsernameAttribute()
    {
        return $this->raw_user_meta_data['username'] ?? null;
    }

    /**
     * Accessor untuk avatar URL dari metadata
     */
    public function getAvatarUrlAttribute()
    {
        return $this->raw_user_meta_data['avatar_url'] ?? null;
    }

    /**
     * Get user's phone number
     */
    public function getPhoneNumberAttribute()
    {
        return $this->phone ?? $this->raw_user_meta_data['phone'] ?? null;
    }

    // ===== RELATIONSHIPS =====

    /**
     * Bills created by this user
     */
    public function bills()
    {
        return $this->hasMany(Bill::class, 'created_by');
    }

    /**
     * Bills where user is participant
     */
    public function billParticipants()
    {
        return $this->hasMany(BillParticipant::class, 'user_id');
    }

    /**
     * Bills user participates in (through BillParticipant)
     */
    public function participatingBills()
    {
        return $this->belongsToMany(Bill::class, 'bill_participants', 'user_id', 'bill_id')
                    ->withPivot(['share_amount', 'share_percentage', 'status', 'joined_at'])
                    ->withTimestamps();
    }

    /**
     * Settlements where user owes money
     */
    public function settlements()
    {
        return $this->hasMany(Settlement::class, 'from_user_id');
    }

    /**
     * Settlements where user receives money
     */
    public function receivedSettlements()
    {
        return $this->hasMany(Settlement::class, 'to_user_id');
    }

    /**
     * User's friendships (sent requests)
     */
    public function friendships()
    {
        return $this->hasMany(Friendship::class, 'user_id');
    }

    /**
     * Friendships where user is the friend (received requests)
     */
    public function receivedFriendships()
    {
        return $this->hasMany(Friendship::class, 'friend_id');
    }

    /**
     * All friends (accepted friendships)
     */
    public function friends()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
                    ->wherePivot('status', 'accepted')
                    ->withPivot(['status', 'requested_at', 'accepted_at'])
                    ->withTimestamps();
    }

    /**
     * Item assignments for this user
     */
    public function itemAssignments()
    {
        return $this->hasMany(ItemAssignment::class, 'user_id');
    }

    // ===== HELPER METHODS =====

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return ($this->raw_app_meta_data['role'] ?? 'user') === 'admin';
    }

    /**
     * Get total amount user owes (pending settlements)
     */
    public function getTotalOwed()
    {
        return $this->settlements()
            ->where('status', 'pending')
            ->sum('amount');
    }

    /**
     * Get total amount user should receive (pending settlements)
     */
    public function getTotalToReceive()
    {
        return $this->receivedSettlements()
            ->where('status', 'pending')
            ->sum('amount');
    }

    /**
     * Get user's net balance (positive = owed to user, negative = user owes)
     */
    public function getNetBalance()
    {
        return $this->getTotalToReceive() - $this->getTotalOwed();
    }

    /**
     * Get total number of bills user created
     */
    public function getTotalBillsCreated()
    {
        return $this->bills()->count();
    }

    /**
     * Get total number of bills user participates in
     */
    public function getTotalBillsParticipating()
    {
        return $this->billParticipants()->count();
    }

    /**
     * Get user's spending total across all bills
     */
    public function getTotalSpending()
    {
        return $this->billParticipants()
            ->where('status', 'accepted')
            ->sum('share_amount');
    }

    /**
     * Check if user is friends with another user
     */
    public function isFriendsWith(User $user)
    {
        return $this->friends()->where('friend_id', $user->id)->exists() ||
               $user->friends()->where('friend_id', $this->id)->exists();
    }

    /**
     * Get pending friend requests sent by this user
     */
    public function getPendingFriendRequests()
    {
        return $this->friendships()
            ->where('status', 'pending')
            ->with('friend')
            ->get();
    }

    /**
     * Get pending friend requests received by this user
     */
    public function getReceivedFriendRequests()
    {
        return $this->receivedFriendships()
            ->where('status', 'pending')
            ->with('user')
            ->get();
    }

    /**
     * Get user's recent activity (bills + settlements)
     */
    public function getRecentActivity($limit = 10)
    {
        $bills = $this->bills()->latest()->take($limit)->get()->map(function ($bill) {
            return [
                'type' => 'bill_created',
                'data' => $bill,
                'created_at' => $bill->created_at,
            ];
        });

        $settlements = $this->settlements()->with('bill')->latest()->take($limit)->get()->map(function ($settlement) {
            return [
                'type' => 'settlement_created',
                'data' => $settlement,
                'created_at' => $settlement->created_at,
            ];
        });

        return $bills->concat($settlements)
                    ->sortByDesc('created_at')
                    ->take($limit)
                    ->values();
    }

    // ===== SCOPES =====

    /**
     * Scope for admin users
     */
    public function scopeAdmins($query)
    {
        return $query->whereJsonContains('raw_app_meta_data->role', 'admin');
    }

    /**
     * Scope for regular users
     */
    public function scopeRegularUsers($query)
    {
        return $query->where(function ($q) {
            $q->whereJsonContains('raw_app_meta_data->role', 'user')
              ->orWhereNull('raw_app_meta_data')
              ->orWhere('raw_app_meta_data', '{}');
        });
    }

    /**
     * Scope for users with verified email
     */
    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    /**
     * Scope for users registered in specific date range
     */
    public function scopeRegisteredBetween($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }
}