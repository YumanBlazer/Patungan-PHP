@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="profile-page">
    <div class="container">
        <div class="profile-header">
            <h1>My Profile</h1>
            <p>Manage your account information</p>
        </div>

        <div class="profile-content">
            <div class="profile-main">
                <div class="profile-info">
                    <div class="profile-avatar">
                        <div class="avatar-circle">
                            {{ strtoupper(substr(session('user.name', 'Demo User'), 0, 1)) }}
                        </div>
                        <button class="change-avatar-btn">Change Photo</button>
                    </div>
                    
                    <form class="profile-form" method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ session('user.name', '') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ session('user.email', '') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="{{ session('user.phone', '') }}">
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                            <button type="button" class="btn btn-secondary" onclick="resetForm()">Cancel</button>
                        </div>
                    </form>
                </div>

                <div class="password-section">
                    <h3>Change Password</h3>
                    <form class="password-form" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" id="current_password" name="current_password" required>
                        </div>

                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" id="new_password" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirm New Password</label>
                            <input type="password" id="confirm_password" name="password_confirmation" required>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-warning">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="profile-sidebar">
                <div class="account-stats">
                    <h3>Account Statistics</h3>
                    <div class="stat-item">
                        <span class="stat-label">Member since</span>
                        <span class="stat-value">{{ session('user.created_at', 'Jan 2024') }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Total bills created</span>
                        <span class="stat-value">{{ $userStats['totalBills'] ?? 0 }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Friends</span>
                        <span class="stat-value">{{ $userStats['totalFriends'] ?? 0 }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Settlements</span>
                        <span class="stat-value">{{ $userStats['totalSettlements'] ?? 0 }}</span>
                    </div>
                </div>

                <div class="account-actions">
                    <h3>Account Actions</h3>
                    <div class="action-list">
                        <button class="action-btn" onclick="exportData()">
                            <span>📊</span>
                            Export My Data
                        </button>
                        <button class="action-btn" onclick="showNotificationSettings()">
                            <span>🔔</span>
                            Notification Settings
                        </button>
                        <button class="action-btn" onclick="showPrivacySettings()">
                            <span>🔒</span>
                            Privacy Settings
                        </button>
                        <button class="action-btn danger" onclick="confirmDeleteAccount()">
                            <span>⚠️</span>
                            Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function resetForm() {
    if (confirm('Are you sure you want to cancel your changes?')) {
        location.reload();
    }
}

function exportData() {
    alert('Export functionality would be implemented here');
}

function showNotificationSettings() {
    alert('Notification settings modal would open here');
}

function showPrivacySettings() {
    alert('Privacy settings modal would open here');
}

function confirmDeleteAccount() {
    if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
        alert('Account deletion would be processed here');
    }
}
</script>

<style>
.profile-page {
    padding: 2rem 0;
}

.profile-header {
    text-align: center;
    margin-bottom: 3rem;
}

.profile-header h1 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.profile-header p {
    color: #7f8c8d;
    margin: 0;
}

.profile-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
}

.profile-main {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.profile-info, .password-section {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.profile-avatar {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.avatar-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #3498db;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: bold;
}

.change-avatar-btn {
    background: #ecf0f1;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    color: #2c3e50;
    cursor: pointer;
    font-size: 0.9rem;
}

.change-avatar-btn:hover {
    background: #d5dbdb;
}

.password-section h3 {
    color: #2c3e50;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: #2c3e50;
    font-weight: 500;
}

.form-group input {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid #ecf0f1;
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.2s;
}

.form-group input:focus {
    outline: none;
    border-color: #3498db;
}

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.profile-sidebar {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.account-stats, .account-actions {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.account-stats h3, .account-actions h3 {
    color: #2c3e50;
    margin-bottom: 1.5rem;
}

.stat-item {
    display: flex;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 1px solid #ecf0f1;
}

.stat-item:last-child {
    border-bottom: none;
}

.stat-label {
    color: #7f8c8d;
}

.stat-value {
    color: #2c3e50;
    font-weight: 500;
}

.action-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: #f8f9fa;
    border: none;
    border-radius: 6px;
    color: #2c3e50;
    cursor: pointer;
    font-size: 0.9rem;
    transition: background 0.2s;
    width: 100%;
    text-align: left;
}

.action-btn:hover {
    background: #e9ecef;
}

.action-btn.danger {
    background: #ffebee;
    color: #c62828;
}

.action-btn.danger:hover {
    background: #ffcdd2;
}

@media (max-width: 768px) {
    .profile-content {
        grid-template-columns: 1fr;
    }
    
    .profile-avatar {
        flex-direction: column;
        text-align: center;
    }
    
    .form-actions {
        flex-direction: column;
    }
}
</style>
@endsection
