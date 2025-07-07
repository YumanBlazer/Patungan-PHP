<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Patungann</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            color: #1e293b;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: white;
            border-right: 1px solid #e2e8f0;
            padding: 2rem 0;
            z-index: 100;
        }
        
        .sidebar-header {
            padding: 0 2rem;
            margin-bottom: 2rem;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #1e293b;
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .logo-icon {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }
        
        .nav-menu {
            padding: 0 1rem;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 8px;
            color: #64748b;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .nav-item:hover, .nav-item.active {
            background: #f1f5f9;
            color: #6366f1;
        }
        
        .nav-item i {
            width: 20px;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            background: #f8fafc;
        }
        
        /* Header */
        .header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .notification-btn {
            position: relative;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #64748b;
            padding: 0.75rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .notification-btn:hover {
            background: #f1f5f9;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 600;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            color: #1e293b;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .user-menu:hover {
            background: #f1f5f9;
        }
        
        .user-avatar {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        /* Content Area */
        .content {
            padding: 2rem;
        }
        
        .welcome-section {
            margin-bottom: 2rem;
        }
        
        .welcome-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        
        .welcome-subtitle {
            color: #64748b;
            font-size: 1rem;
        }
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.2s ease;
        }
        
        .stat-card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        
        .stat-title {
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
        }
        
        .stat-icon.balance { background: linear-gradient(135deg, #6366f1, #8b5cf6); }
        .stat-icon.bills { background: linear-gradient(135deg, #ec4899, #f43f5e); }
        .stat-icon.friends { background: linear-gradient(135deg, #06b6d4, #0ea5e9); }
        .stat-icon.activity { background: linear-gradient(135deg, #10b981, #059669); }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }
        
        .stat-change {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .stat-change.positive { color: #10b981; }
        .stat-change.negative { color: #ef4444; }
        
        /* Activity Grid */
        .activity-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }
        
        .activity-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.5rem;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e293b;
        }
        
        .view-all-link {
            color: #6366f1;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        /* Activity Items */
        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: white;
        }
        
        .activity-icon.expense { background: linear-gradient(135deg, #ec4899, #f43f5e); }
        .activity-icon.payment { background: linear-gradient(135deg, #10b981, #059669); }
        
        .activity-info {
            flex: 1;
        }
        
        .activity-title {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
        }
        
        .activity-subtitle {
            color: #64748b;
            font-size: 0.8rem;
        }
        
        .activity-amount {
            font-weight: 700;
            font-size: 0.9rem;
        }
        
        .activity-amount.expense { color: #ef4444; }
        .activity-amount.income { color: #10b981; }
        
        /* Bill Items */
        .bill-item {
            padding: 1rem 0;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .bill-item:last-child {
            border-bottom: none;
        }
        
        .bill-title {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
        }
        
        .bill-date {
            color: #64748b;
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
        }
        
        .bill-amount {
            color: #1e293b;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
        }
        
        .bill-participants {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
        }
        
        .participant-avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 600;
            color: white;
        }
        
        .participants-more {
            color: #64748b;
            font-size: 0.8rem;
        }
        
        .bill-status {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            background: #dcfce7;
            color: #16a34a;
        }
        
        .progress-bar {
            flex: 1;
            height: 6px;
            background: #f1f5f9;
            border-radius: 3px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 3px;
            transition: width 0.3s ease;
        }
        
        .progress-text {
            color: #64748b;
            font-size: 0.8rem;
            margin-left: 0.5rem;
        }
        
        /* Quick Actions */
        .quick-actions {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
        }
        
        .btn-primary {
            background: #6366f1;
            color: white;
        }
        
        .btn-primary:hover {
            background: #5856eb;
        }
        
        .btn-secondary {
            background: white;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }
        
        .btn-secondary:hover {
            background: #f8fafc;
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .activity-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .quick-actions {
                flex-direction: column;
            }
            
            .user-menu span {
                display: none;
            }
            
            .content {
                padding: 1rem;
            }
        }
        
        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .stat-card,
            .activity-card {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <div class="logo-icon">💰</div>
                Patungann
            </div>
        </div>
        
        <nav class="nav-menu">
            <a href="#" class="nav-item active">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-receipt"></i>
                Bills
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-users"></i>
                Friends
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-chart-bar"></i>
                Analytics
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-cog"></i>
                Settings
            </a>
        </nav>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="header">
            <h1 class="page-title">Dashboard</h1>
            
            <div class="header-actions">
                <button class="notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                
                <div class="user-menu">
                    <div class="user-avatar">{{ substr(session('user.name', 'Demo User'), 0, 2) }}</div>
                    <span>{{ session('user.name', 'Demo User') }}</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </header>
        
        <!-- Content -->
        <div class="content">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <h2 class="welcome-title">Welcome back, {{ session('user.name', 'Demo User') }}!</h2>
                <p class="welcome-subtitle">Here's what's happening with your bills and expenses.</p>
            </div>
            
            <!-- Quick Actions -->
            <div class="quick-actions">
                <a href="#" class="btn btn-primary" onclick="showCreateBillModal()">
                    <i class="fas fa-plus"></i>
                    Create Bill
                </a>
                <a href="#" class="btn btn-secondary">
                    <i class="fas fa-users"></i>
                    Add Friends
                </a>
                <a href="#" class="btn btn-secondary">
                    <i class="fas fa-money-bill-wave"></i>
                    Settle Up
                </a>
            </div>
            
            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Total Balance</div>
                            <div class="stat-value">$1,245.50</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                +12.3% from last month
                            </div>
                        </div>
                        <div class="stat-icon balance">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Active Bills</div>
                            <div class="stat-value">8</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                +2 new this week
                            </div>
                        </div>
                        <div class="stat-icon bills">
                            <i class="fas fa-receipt"></i>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Friends</div>
                            <div class="stat-value">24</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                +3 this month
                            </div>
                        </div>
                        <div class="stat-icon friends">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div>
                            <div class="stat-title">Recent Activity</div>
                            <div class="stat-value">12</div>
                            <div class="stat-change positive">
                                <i class="fas fa-arrow-up"></i>
                                5 transactions today
                            </div>
                        </div>
                        <div class="stat-icon activity">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Activity Grid -->
            <div class="activity-grid">
                <!-- Recent Activity -->
                <div class="activity-card">
                    <div class="card-header">
                        <h3 class="card-title">Recent Activity</h3>
                        <a href="#" class="view-all-link">View all</a>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon expense">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div class="activity-info">
                            <div class="activity-title">Dinner at Sushi Place</div>
                            <div class="activity-subtitle">Split with 4 friends • 2 hours ago</div>
                        </div>
                        <div class="activity-amount expense">-$45.60</div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon payment">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="activity-info">
                            <div class="activity-title">Payment from Mike</div>
                            <div class="activity-subtitle">Movie night expenses • 1 day ago</div>
                        </div>
                        <div class="activity-amount income">+$28.50</div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon expense">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="activity-info">
                            <div class="activity-title">Grocery Shopping</div>
                            <div class="activity-subtitle">Weekly groceries • 3 days ago</div>
                        </div>
                        <div class="activity-amount expense">-$127.30</div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon payment">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div class="activity-info">
                            <div class="activity-title">Payment from Sarah</div>
                            <div class="activity-subtitle">Coffee meetup • 5 days ago</div>
                        </div>
                        <div class="activity-amount income">+$15.75</div>
                    </div>
                </div>
                
                <!-- Recent Bills -->
                <div class="activity-card">
                    <div class="card-header">
                        <h3 class="card-title">Recent Bills</h3>
                        <a href="#" class="view-all-link">View all</a>
                    </div>
                    
                    <div class="bill-item">
                        <div class="bill-title">Weekend Trip to Lake</div>
                        <div class="bill-date">January 15, 2025</div>
                        <div class="bill-amount">$456.80</div>
                        <div class="bill-participants">
                            <div class="participant-avatar">JD</div>
                            <div class="participant-avatar">SM</div>
                            <div class="participant-avatar">AK</div>
                            <span class="participants-more">+2 more</span>
                        </div>
                        <div class="bill-status">
                            <span class="status-badge">Active</span>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 65%;"></div>
                            </div>
                            <span class="progress-text">65%</span>
                        </div>
                    </div>
                    
                    <div class="bill-item">
                        <div class="bill-title">Monthly Utilities</div>
                        <div class="bill-date">January 10, 2025</div>
                        <div class="bill-amount">$185.40</div>
                        <div class="bill-participants">
                            <div class="participant-avatar">MB</div>
                            <div class="participant-avatar">LK</div>
                        </div>
                        <div class="bill-status">
                            <span class="status-badge">Active</span>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 85%;"></div>
                            </div>
                            <span class="progress-text">85%</span>
                        </div>
                    </div>
                    
                    <div class="bill-item">
                        <div class="bill-title">Team Lunch</div>
                        <div class="bill-date">January 8, 2025</div>
                        <div class="bill-amount">$98.25</div>
                        <div class="bill-participants">
                            <div class="participant-avatar">RT</div>
                            <div class="participant-avatar">PL</div>
                            <div class="participant-avatar">NK</div>
                            <span class="participants-more">+1 more</span>
                        </div>
                        <div class="bill-status">
                            <span class="status-badge">Active</span>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 100%;"></div>
                            </div>
                            <span class="progress-text">Paid</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Success Message -->
    @if(session('success'))
        <div style="position: fixed; top: 20px; right: 20px; background: #10b981; color: white; padding: 1rem 1.5rem; border-radius: 8px; font-weight: 500; z-index: 1000; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                const alert = document.querySelector('[style*="position: fixed"]');
                if (alert) alert.remove();
            }, 5000);
        </script>
    @endif
    
    <!-- Logout Form -->
    <form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>
    
    <script>
        // User menu functionality
        document.querySelector('.user-menu').addEventListener('click', function() {
            const menu = document.createElement('div');
            menu.style.cssText = `
                position: absolute;
                top: 100%;
                right: 0;
                background: white;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                padding: 0.5rem;
                margin-top: 0.5rem;
                min-width: 180px;
                z-index: 1000;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            `;
            
            menu.innerHTML = `
                <a href="#" style="display: block; padding: 0.75rem; color: #374151; text-decoration: none; border-radius: 6px; transition: all 0.2s ease;" 
                   onmouseover="this.style.background='#f9fafb'" 
                   onmouseout="this.style.background='transparent'">
                    <i class="fas fa-user" style="margin-right: 0.5rem; color: #6b7280;"></i>Profile
                </a>
                <a href="#" style="display: block; padding: 0.75rem; color: #374151; text-decoration: none; border-radius: 6px; transition: all 0.2s ease;"
                   onmouseover="this.style.background='#f9fafb'" 
                   onmouseout="this.style.background='transparent'">
                    <i class="fas fa-cog" style="margin-right: 0.5rem; color: #6b7280;"></i>Settings
                </a>
                <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 0.5rem 0;">
                <a href="#" onclick="document.getElementById('logoutForm').submit(); return false;" 
                   style="display: block; padding: 0.75rem; color: #dc2626; text-decoration: none; border-radius: 6px; transition: all 0.2s ease;"
                   onmouseover="this.style.background='#fef2f2'" 
                   onmouseout="this.style.background='transparent'">
                    <i class="fas fa-sign-out-alt" style="margin-right: 0.5rem;"></i>Logout
                </a>
            `;
            
            // Remove existing menu if any
            const existingMenu = document.querySelector('.user-dropdown-menu');
            if (existingMenu) existingMenu.remove();
            
            menu.className = 'user-dropdown-menu';
            this.style.position = 'relative';
            this.appendChild(menu);
            
            // Close menu when clicking outside
            setTimeout(() => {
                document.addEventListener('click', function closeMenu(e) {
                    if (!menu.contains(e.target) && !e.target.closest('.user-menu')) {
                        menu.remove();
                        document.removeEventListener('click', closeMenu);
                    }
                });
            }, 0);
        });
        
        // Create bill modal placeholder
        function showCreateBillModal() {
            alert('Create Bill feature will be implemented soon!');
        }
        
        // Notification button functionality
        document.querySelector('.notification-btn').addEventListener('click', function() {
            alert('Notifications feature will be implemented soon!');
        });
        
        // Mobile sidebar toggle (for future implementation)
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.transform = sidebar.style.transform === 'translateX(0px)' ? 'translateX(-100%)' : 'translateX(0px)';
        }
    </script>
</body>
</html>
</body>
</html>
