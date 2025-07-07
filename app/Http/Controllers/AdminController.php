<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bill;
use App\Models\Settlement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Admin dashboard stats
        $stats = [
            'total_users' => User::count(),
            'total_bills' => Bill::count(),
            'active_bills' => Bill::where('status', 'active')->count(),
            'total_settlements' => Settlement::count(),
            'pending_settlements' => Settlement::pending()->count(),
            'total_revenue' => Settlement::completed()->sum('amount'),
        ];

        // Recent activity
        $recentUsers = User::latest()->take(5)->get();
        $recentBills = Bill::with('creator')->latest()->take(5)->get();

        // Monthly stats
        $monthlyStats = $this->getMonthlyStats();

        return view('admin.index', compact('stats', 'recentUsers', 'recentBills', 'monthlyStats'));
    }

    public function analytics()
    {
        // User analytics
        $userGrowth = $this->getUserGrowthData();
        $billCategories = $this->getBillCategoryData();
        $settlementStats = $this->getSettlementStats();

        return view('admin.analytics', compact('userGrowth', 'billCategories', 'settlementStats'));
    }

    public function users()
    {
        $users = User::with(['bills', 'settlements'])
            ->withCount(['bills', 'settlements'])
            ->latest()
            ->paginate(20);

        return view('admin.users', compact('users'));
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function revenue()
    {
        $revenueData = $this->getRevenueData();
        
        return view('admin.revenue', compact('revenueData'));
    }

    public function spendingAnalysis()
    {
        $spendingData = $this->getSpendingAnalysisData();
        
        return view('admin.spending-analysis', compact('spendingData'));
    }

    // Helper methods for analytics
    private function getMonthlyStats()
    {
        $months = collect();
        
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            
            $months->push([
                'month' => $date->format('M Y'),
                'users' => User::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'bills' => Bill::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'revenue' => Settlement::completed()
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->sum('amount'),
            ]);
        }

        return $months;
    }

    private function getUserGrowthData()
    {
        return User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    private function getBillCategoryData()
    {
        return Bill::selectRaw('category, COUNT(*) as count, AVG(total_amount) as avg_amount')
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->get();
    }

    private function getSettlementStats()
    {
        return [
            'total' => Settlement::count(),
            'pending' => Settlement::pending()->count(),
            'completed' => Settlement::completed()->count(),
            'total_amount' => Settlement::sum('amount'),
            'pending_amount' => Settlement::pending()->sum('amount'),
            'completed_amount' => Settlement::completed()->sum('amount'),
        ];
    }

    private function getRevenueData()
    {
        return [
            'daily' => Settlement::completed()
                ->selectRaw('DATE(created_at) as date, SUM(amount) as total')
                ->where('created_at', '>=', Carbon::now()->subDays(30))
                ->groupBy('date')
                ->orderBy('date')
                ->get(),
            'monthly' => Settlement::completed()
                ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(amount) as total')
                ->where('created_at', '>=', Carbon::now()->subYear())
                ->groupBy('year', 'month')
                ->orderBy('year')
                ->orderBy('month')
                ->get(),
        ];
    }

    private function getSpendingAnalysisData()
    {
        return [
            'by_category' => Bill::selectRaw('category, COUNT(*) as count, SUM(total_amount) as total, AVG(total_amount) as average')
                ->groupBy('category')
                ->orderBy('total', 'desc')
                ->get(),
            'by_user' => User::withSum('bills', 'total_amount')
                ->withCount('bills')
                ->orderBy('bills_sum_total_amount', 'desc')
                ->take(10)
                ->get(),
        ];
    }
}
