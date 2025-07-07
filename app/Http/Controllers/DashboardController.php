<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bill;
use App\Models\Settlement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Dashboard stats
        $stats = [
            'total_bills' => $user->bills()->count(),
            'pending_settlements' => $user->settlements()->where('status', 'pending')->count(),
            'total_owed' => $user->settlements()->where('status', 'pending')->sum('amount'),
            'total_to_receive' => $user->receivedSettlements()->where('status', 'pending')->sum('amount'),
        ];

        // Recent bills
        $recentBills = $user->bills()
            ->with(['participants', 'items'])
            ->latest()
            ->take(5)
            ->get();

        // Pending settlements
        $pendingSettlements = $user->settlements()
            ->with(['bill', 'toUser'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact('stats', 'recentBills', 'pendingSettlements'));
    }

    public function userApp()
    {
        return view('app.index');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('app.profile', compact('user'));
    }

    public function history()
    {
        $user = Auth::user();
        
        $bills = $user->bills()
            ->with(['participants', 'settlements'])
            ->latest()
            ->paginate(10);

        return view('app.history', compact('bills'));
    }

    public function social()
    {
        $user = Auth::user();
        
        $friends = $user->friendships()
            ->with('friend')
            ->where('status', 'accepted')
            ->get();

        $pendingRequests = $user->friendships()
            ->with('friend')
            ->where('status', 'pending')
            ->get();

        return view('app.social', compact('friends', 'pendingRequests'));
    }
}
