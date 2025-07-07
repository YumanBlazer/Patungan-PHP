@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="admin-dashboard">
    <div class="container">
        <div class="admin-header">
            <h1>Admin Dashboard</h1>
            <p>Welcome to the Patungann Admin Panel</p>
        </div>

        <div class="admin-stats">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-content">
                    <h3>{{ $totalUsers ?? 0 }}</h3>
                    <p>Total Users</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📄</div>
                <div class="stat-content">
                    <h3>{{ $totalBills ?? 0 }}</h3>
                    <p>Total Bills</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-content">
                    <h3>Rp {{ number_format($totalAmount ?? 0) }}</h3>
                    <p>Total Amount</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-content">
                    <h3>{{ $totalSettlements ?? 0 }}</h3>
                    <p>Settlements</p>
                </div>
            </div>
        </div>

        <div class="admin-sections">
            <div class="admin-section">
                <h2>Quick Actions</h2>
                <div class="action-buttons">
                    <a href="{{ route('admin.users') }}" class="btn btn-primary">
                        <span>👥</span>
                        Manage Users
                    </a>
                    <a href="{{ route('admin.analytics') }}" class="btn btn-secondary">
                        <span>📊</span>
                        View Analytics
                    </a>
                    <a href="{{ route('admin.revenue') }}" class="btn btn-success">
                        <span>💵</span>
                        Revenue Reports
                    </a>
                    <a href="{{ route('admin.settings') }}" class="btn btn-warning">
                        <span>⚙️</span>
                        System Settings
                    </a>
                </div>
            </div>

            <div class="admin-section">
                <h2>Recent Activity</h2>
                <div class="activity-list">
                    @if(isset($recentActivity) && count($recentActivity) > 0)
                        @foreach($recentActivity as $activity)
                        <div class="activity-item">
                            <div class="activity-icon">📝</div>
                            <div class="activity-content">
                                <p>{{ $activity['description'] }}</p>
                                <small>{{ $activity['time'] }}</small>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="no-activity">
                            <p>No recent activity</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.admin-dashboard {
    padding: 2rem 0;
}

.admin-header {
    text-align: center;
    margin-bottom: 3rem;
}

.admin-header h1 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.admin-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-icon {
    font-size: 2rem;
    background: #3498db;
    color: white;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stat-content h3 {
    font-size: 1.8rem;
    color: #2c3e50;
    margin: 0;
}

.stat-content p {
    color: #7f8c8d;
    margin: 0;
}

.admin-sections {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

.admin-section {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.admin-section h2 {
    color: #2c3e50;
    margin-bottom: 1.5rem;
}

.action-buttons {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
}

.action-buttons .btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem;
    text-decoration: none;
    border-radius: 8px;
    transition: transform 0.2s;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
}

.activity-list {
    max-height: 300px;
    overflow-y: auto;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid #ecf0f1;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    font-size: 1.2rem;
    background: #ecf0f1;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.activity-content p {
    margin: 0;
    color: #2c3e50;
}

.activity-content small {
    color: #7f8c8d;
}

.no-activity {
    text-align: center;
    padding: 2rem;
    color: #7f8c8d;
}
</style>
@endsection
