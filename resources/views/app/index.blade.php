@extends('layouts.app')

@section('title', 'Patungann App')

@section('content')
<div class="app-interface">
    <div class="container">
        <div class="app-header">
            <div class="user-welcome">
                <h1>Hello, {{ session('user.name', 'Demo User') }}!</h1>
                <p>Welcome to your Patungann dashboard</p>
            </div>
            <div class="quick-actions">
                <a href="#" class="btn btn-primary" onclick="showCreateBillModal()">
                    <span>➕</span>
                    New Bill
                </a>
                <a href="#" class="btn btn-secondary" onclick="showReceiptUploader()">
                    <span>📷</span>
                    Scan Receipt
                </a>
            </div>
        </div>

        <div class="app-overview">
            <div class="overview-card">
                <div class="card-icon">📄</div>
                <div class="card-content">
                    <h3>{{ $userStats['activeBills'] ?? 0 }}</h3>
                    <p>Active Bills</p>
                </div>
            </div>
            <div class="overview-card">
                <div class="card-icon">💰</div>
                <div class="card-content">
                    <h3>Rp {{ number_format($userStats['totalOwed'] ?? 0) }}</h3>
                    <p>You Owe</p>
                </div>
            </div>
            <div class="overview-card">
                <div class="card-icon">💸</div>
                <div class="card-content">
                    <h3>Rp {{ number_format($userStats['totalOwedToYou'] ?? 0) }}</h3>
                    <p>Owed to You</p>
                </div>
            </div>
            <div class="overview-card">
                <div class="card-icon">👥</div>
                <div class="card-content">
                    <h3>{{ $userStats['friends'] ?? 0 }}</h3>
                    <p>Friends</p>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="recent-bills">
                <div class="section-header">
                    <h2>Recent Bills</h2>
                    <a href="{{ route('app.history') }}" class="view-all">View All</a>
                </div>
                <div class="bills-list">
                    @if(isset($recentBills) && count($recentBills) > 0)
                        @foreach($recentBills as $bill)
                        <div class="bill-item">
                            <div class="bill-info">
                                <h4>{{ $bill->title }}</h4>
                                <p>{{ $bill->description }}</p>
                                <small>{{ $bill->created_at->format('M d, Y') }}</small>
                            </div>
                            <div class="bill-amount">
                                <span class="amount">Rp {{ number_format($bill->total_amount) }}</span>
                                <span class="status status-{{ $bill->status }}">{{ ucfirst($bill->status) }}</span>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="no-bills">
                            <div class="no-bills-icon">📄</div>
                            <h3>No bills yet</h3>
                            <p>Create your first bill to get started</p>
                            <button class="btn btn-primary" onclick="showCreateBillModal()">Create Bill</button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="app-sidebar">
                <div class="quick-links">
                    <h3>Quick Links</h3>
                    <div class="link-grid">
                        <a href="{{ route('app.profile') }}" class="quick-link">
                            <span>👤</span>
                            Profile
                        </a>
                        <a href="{{ route('app.social') }}" class="quick-link">
                            <span>👥</span>
                            Friends
                        </a>
                        <a href="{{ route('app.history') }}" class="quick-link">
                            <span>📊</span>
                            History
                        </a>
                        <a href="#" class="quick-link" onclick="showSettings()">
                            <span>⚙️</span>
                            Settings
                        </a>
                    </div>
                </div>

                <div class="notifications">
                    <h3>Notifications</h3>
                    <div class="notification-list">
                        @if(isset($notifications) && count($notifications) > 0)
                            @foreach($notifications as $notification)
                            <div class="notification-item">
                                <div class="notification-icon">{{ $notification['icon'] }}</div>
                                <div class="notification-content">
                                    <p>{{ $notification['message'] }}</p>
                                    <small>{{ $notification['time'] }}</small>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="no-notifications">
                                <p>No new notifications</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals and Scripts will be added here -->
<script>
function showCreateBillModal() {
    alert('Create Bill modal would open here');
    // Implementation for create bill modal
}

function showReceiptUploader() {
    alert('Receipt uploader would open here');
    // Implementation for receipt scanner
}

function showSettings() {
    alert('Settings modal would open here');
    // Implementation for settings
}
</script>

<style>
.app-interface {
    padding: 2rem 0;
}

.app-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.user-welcome h1 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.user-welcome p {
    color: #7f8c8d;
    margin: 0;
}

.quick-actions {
    display: flex;
    gap: 1rem;
}

.app-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.overview-card {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.card-icon {
    font-size: 2rem;
    background: #3498db;
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card-content h3 {
    font-size: 1.5rem;
    color: #2c3e50;
    margin: 0;
}

.card-content p {
    color: #7f8c8d;
    margin: 0;
    font-size: 0.9rem;
}

.app-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
}

.recent-bills {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.section-header h2 {
    color: #2c3e50;
    margin: 0;
}

.view-all {
    color: #3498db;
    text-decoration: none;
    font-weight: 500;
}

.view-all:hover {
    text-decoration: underline;
}

.bill-item {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 1rem 0;
    border-bottom: 1px solid #ecf0f1;
}

.bill-item:last-child {
    border-bottom: none;
}

.bill-info h4 {
    color: #2c3e50;
    margin: 0 0 0.5rem 0;
}

.bill-info p {
    color: #7f8c8d;
    margin: 0 0 0.5rem 0;
    font-size: 0.9rem;
}

.bill-info small {
    color: #95a5a6;
}

.bill-amount {
    text-align: right;
}

.amount {
    display: block;
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.status {
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.status-active {
    background: #fff3cd;
    color: #856404;
}

.status-settled {
    background: #d4edda;
    color: #155724;
}

.status-pending {
    background: #f8d7da;
    color: #721c24;
}

.no-bills {
    text-align: center;
    padding: 3rem 1rem;
    color: #7f8c8d;
}

.no-bills-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
}

.no-bills h3 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.app-sidebar {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.quick-links, .notifications {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.quick-links h3, .notifications h3 {
    color: #2c3e50;
    margin-bottom: 1rem;
}

.link-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
}

.quick-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 8px;
    text-decoration: none;
    color: #2c3e50;
    font-size: 0.9rem;
    transition: background 0.2s;
}

.quick-link:hover {
    background: #e9ecef;
}

.notification-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.75rem 0;
    border-bottom: 1px solid #ecf0f1;
}

.notification-item:last-child {
    border-bottom: none;
}

.notification-icon {
    font-size: 1.1rem;
    background: #ecf0f1;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.notification-content p {
    margin: 0;
    color: #2c3e50;
    font-size: 0.9rem;
}

.notification-content small {
    color: #7f8c8d;
}

.no-notifications {
    text-align: center;
    padding: 1rem;
    color: #7f8c8d;
}

@media (max-width: 768px) {
    .app-content {
        grid-template-columns: 1fr;
    }
    
    .app-header {
        flex-direction: column;
        align-items: stretch;
    }
    
    .quick-actions {
        justify-content: center;
    }
    
    .link-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
