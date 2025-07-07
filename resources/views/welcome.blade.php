@extends('layouts.app')

@section('title', 'Patungann - Smart Bill Splitting Made Easy')

@section('content')
<!-- Hero Section -->
<section style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; position: relative;">
    <!-- Overlay -->
    <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.2);"></div>
    
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; position: relative; z-index: 10;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center;">
            <!-- Left Content -->
            <div style="animation: fadeInUp 0.8s ease-out;">
                <h1 style="font-size: 3.5rem; font-weight: bold; color: white; margin-bottom: 24px; line-height: 1.1;">
                    Split Bills <span style="color: #fbbf24;">Smarter</span>, Not Harder
                </h1>
                
                <p style="font-size: 1.25rem; color: rgba(255,255,255,0.9); margin-bottom: 32px; line-height: 1.6;">
                    Stop the awkward calculations and endless group chats. Patungann makes bill splitting effortless with AI-powered receipt scanning and smart expense tracking.
                </p>

                <div style="display: flex; gap: 16px; margin-bottom: 32px; flex-wrap: wrap;">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary" style="font-size: 1.1rem; padding: 16px 32px; text-decoration: none;">
                            Go to Dashboard
                        </a>
                        <a href="{{ route('bills.create') }}" class="btn-secondary" style="font-size: 1.1rem; padding: 16px 32px; text-decoration: none;">
                            Create New Bill
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn-primary" style="font-size: 1.1rem; padding: 16px 32px; text-decoration: none;">
                            Get Started Free
                        </a>
                        <a href="{{ route('login') }}" class="btn-secondary" style="font-size: 1.1rem; padding: 16px 32px; text-decoration: none;">
                            Sign In
                        </a>
                    @endauth
                </div>

                <!-- Features List -->
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="color: #10b981; font-size: 1.2rem;">✓</span>
                        <span style="color: white;">AI Receipt Scanning</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="color: #10b981; font-size: 1.2rem;">✓</span>
                        <span style="color: white;">Smart Bill Splitting</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="color: #10b981; font-size: 1.2rem;">✓</span>
                        <span style="color: white;">Real-time Notifications</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="color: #10b981; font-size: 1.2rem;">✓</span>
                        <span style="color: white;">Expense Analytics</span>
                    </div>
                </div>
            </div>

            <!-- Right Content - Phone Mockup -->
            <div style="text-align: center;">
                <div style="background: white; border-radius: 24px; padding: 24px; box-shadow: 0 25px 50px rgba(0,0,0,0.25); max-width: 300px; margin: 0 auto;">
                    <img src="{{ asset('logo.png') }}" alt="Patungann App" style="width: 100%; height: auto; border-radius: 12px;">
                    <div style="margin-top: 16px; padding: 16px; background: #f8fafc; border-radius: 12px;">
                        <h3 style="font-size: 1.1rem; font-weight: 600; color: #1f2937; margin-bottom: 8px;">Latest Bill</h3>
                        <p style="color: #6b7280; font-size: 0.9rem;">Dinner at Restaurant ABC</p>
                        <p style="color: #059669; font-weight: 600; font-size: 1.2rem; margin-top: 8px;">$45.67 per person</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section style="padding: 80px 0; background: #f8fafc;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div style="text-align: center; margin-bottom: 64px;">
            <h2 style="font-size: 2.5rem; font-weight: bold; color: #1f2937; margin-bottom: 16px;">
                Why Choose Patungann?
            </h2>
            <p style="font-size: 1.2rem; color: #6b7280; max-width: 600px; margin: 0 auto;">
                Experience the future of bill splitting with our innovative features designed to make your life easier.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 32px;">
            <!-- Feature 1 -->
            <div style="background: white; padding: 32px; border-radius: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); text-align: center;">
                <div style="background: #3b82f6; color: white; width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; font-size: 1.5rem;">
                    📸
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 16px;">AI Receipt Scanning</h3>
                <p style="color: #6b7280; line-height: 1.6;">
                    Simply snap a photo of your receipt and let our AI automatically extract items and amounts.
                </p>
            </div>

            <!-- Feature 2 -->
            <div style="background: white; padding: 32px; border-radius: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); text-align: center;">
                <div style="background: #10b981; color: white; width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; font-size: 1.5rem;">
                    ⚡
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 16px;">Smart Splitting</h3>
                <p style="color: #6b7280; line-height: 1.6;">
                    Split bills equally, by custom amounts, or by percentage with intelligent calculation.
                </p>
            </div>

            <!-- Feature 3 -->
            <div style="background: white; padding: 32px; border-radius: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); text-align: center;">
                <div style="background: #f59e0b; color: white; width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; font-size: 1.5rem;">
                    📊
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin-bottom: 16px;">Expense Analytics</h3>
                <p style="color: #6b7280; line-height: 1.6;">
                    Track your spending patterns and get insights into your group expenses over time.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section style="padding: 80px 0; background: linear-gradient(135deg, #1f2937 0%, #111827 100%);">
    <div style="max-width: 800px; margin: 0 auto; padding: 0 20px; text-align: center;">
        <h2 style="font-size: 2.5rem; font-weight: bold; color: white; margin-bottom: 16px;">
            Ready to Split Bills Like a Pro?
        </h2>
        <p style="font-size: 1.2rem; color: rgba(255,255,255,0.8); margin-bottom: 32px;">
            Join thousands of users who have simplified their bill splitting experience.
        </p>
        
        @guest
            <a href="{{ route('register') }}" class="btn-primary" style="font-size: 1.1rem; padding: 16px 32px; text-decoration: none;">
                Start Splitting for Free
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="btn-primary" style="font-size: 1.1rem; padding: 16px 32px; text-decoration: none;">
                Go to Your Dashboard
            </a>
        @endguest
    </div>
</section>

@push('styles')
<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    h1 {
        font-size: 2.5rem !important;
    }
    
    div[style*="grid-template-columns: 1fr 1fr"] {
        grid-template-columns: 1fr !important;
        text-align: center;
    }
    
    div[style*="grid-template-columns: repeat(2, 1fr)"] {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endpush
@endsection
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary text-lg px-8 py-4">
                            Get Started Free
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-secondary text-lg px-8 py-4">
                            Sign In
                        </a>
                    @endauth
                </div>

                <!-- Features List -->
                <div class="flex flex-wrap gap-6 text-sm text-muted-foreground">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>AI Receipt Scanning</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Smart Split Calculations</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Real-time Settlements</span>
                    </div>
                </div>
            </div>

            <!-- Right Content - App Preview -->
            <div class="animate-fade-in-up lg:block hidden">
                <div class="relative">
                    <!-- Phone Mockup -->
                    <div class="bg-card border border-border rounded-3xl p-6 shadow-2xl">
                        <div class="bg-background rounded-2xl p-4">
                            <!-- Mock App Header -->
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-2">
                                    <img src="{{ asset('logo.png') }}" alt="Patungann" class="h-6 w-6">
                                    <span class="font-semibold">Patungann</span>
                                </div>
                                <div class="w-6 h-6 bg-primary rounded-full"></div>
                            </div>

                            <!-- Mock Recent Bills -->
                            <div class="space-y-3">
                                <h3 class="font-medium text-sm text-muted-foreground">Recent Bills</h3>
                                
                                <div class="card p-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="font-medium">Dinner at Sushi Tei</h4>
                                            <p class="text-sm text-muted-foreground">3 people • Jan 15</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium">Rp 450,000</p>
                                            <p class="text-sm text-chart-color-2">Settled</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card p-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="font-medium">Coffee & Snacks</h4>
                                            <p class="text-sm text-muted-foreground">2 people • Jan 14</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium">Rp 85,000</p>
                                            <p class="text-sm text-chart-color-1">Pending</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card p-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="font-medium">Grab to Mall</h4>
                                            <p class="text-sm text-muted-foreground">4 people • Jan 13</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium">Rp 125,000</p>
                                            <p class="text-sm text-chart-color-2">Settled</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Mock Quick Actions -->
                            <div class="mt-6 grid grid-cols-2 gap-3">
                                <button class="btn btn-primary">
                                    + New Bill
                                </button>
                                <button class="btn btn-secondary">
                                    Scan Receipt
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Elements -->
                    <div class="absolute -top-4 -right-4 bg-chart-color-1 text-white rounded-full p-3 shadow-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>

                    <div class="absolute -bottom-4 -left-4 bg-chart-color-2 text-white rounded-full p-3 shadow-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-card">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-foreground mb-6">
                Why Choose Patungann?
            </h2>
            <p class="text-xl text-muted-foreground max-w-2xl mx-auto">
                Experience the future of bill splitting with our AI-powered platform designed for modern lifestyles.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="text-center animate-fade-in-up">
                <div class="bg-primary/10 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"></path>
                        <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-foreground mb-4">AI Receipt Scanning</h3>
                <p class="text-muted-foreground">
                    Simply snap a photo of your receipt and let our AI extract all items, prices, and taxes automatically.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="text-center animate-fade-in-up">
                <div class="bg-primary/10 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-foreground mb-4">Smart Split Options</h3>
                <p class="text-muted-foreground">
                    Choose from equal splits, custom amounts, or item-by-item assignments. Perfect for any scenario.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="text-center animate-fade-in-up">
                <div class="bg-primary/10 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-foreground mb-4">Real-time Settlements</h3>
                <p class="text-muted-foreground">
                    Track payments instantly and get notified when friends settle their shares. No more chasing payments.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-20 bg-background">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="animate-fade-in-up">
                <div class="text-3xl lg:text-4xl font-bold text-primary mb-2">10K+</div>
                <div class="text-muted-foreground">Bills Split</div>
            </div>
            <div class="animate-fade-in-up">
                <div class="text-3xl lg:text-4xl font-bold text-primary mb-2">5K+</div>
                <div class="text-muted-foreground">Happy Users</div>
            </div>
            <div class="animate-fade-in-up">
                <div class="text-3xl lg:text-4xl font-bold text-primary mb-2">99.9%</div>
                <div class="text-muted-foreground">Accuracy</div>
            </div>
            <div class="animate-fade-in-up">
                <div class="text-3xl lg:text-4xl font-bold text-primary mb-2">24/7</div>
                <div class="text-muted-foreground">Support</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-primary">
    <div class="container mx-auto px-4 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl lg:text-4xl font-bold text-primary-foreground mb-6">
                Ready to Simplify Your Bill Splitting?
            </h2>
            <p class="text-xl text-primary-foreground/80 mb-8">
                Join thousands of users who have made bill splitting effortless with Patungann.
            </p>
            
            @auth
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('dashboard') }}" class="btn bg-white text-primary hover:bg-gray-100 text-lg px-8 py-4">
                        Go to Dashboard
                    </a>
                    <a href="{{ route('bills.create') }}" class="btn border-2 border-white text-white hover:bg-white hover:text-primary text-lg px-8 py-4">
                        Create Your First Bill
                    </a>
                </div>
            @else
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="btn bg-white text-primary hover:bg-gray-100 text-lg px-8 py-4">
                        Get Started Free
                    </a>
                    <a href="{{ route('login') }}" class="btn border-2 border-white text-white hover:bg-white hover:text-primary text-lg px-8 py-4">
                        Sign In
                    </a>
                </div>
            @endauth
        </div>
    </div>
</section>
@endsection

@section('footer')
<footer class="bg-card border-t border-border py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo & Description -->
            <div class="md:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <img src="{{ asset('logo.png') }}" alt="Patungann" class="h-8 w-8">
                    <span class="font-bold text-xl text-primary">Patungann</span>
                </div>
                <p class="text-muted-foreground mb-4">
                    Making bill splitting effortless with AI-powered technology. Split smarter, not harder.
                </p>
                <div class="flex gap-4">
                    <!-- Social Media Icons -->
                    <a href="#" class="text-muted-foreground hover:text-primary">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-muted-foreground hover:text-primary">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-muted-foreground hover:text-primary">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.758-1.378l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.624 0 11.99-5.367 11.99-11.987C24.007 5.367 18.641.001.012.001z.017 0z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="font-semibold text-foreground mb-4">Features</h3>
                <ul class="space-y-2 text-muted-foreground">
                    <li><a href="#" class="hover:text-primary">AI Receipt Scanning</a></li>
                    <li><a href="#" class="hover:text-primary">Smart Bill Splitting</a></li>
                    <li><a href="#" class="hover:text-primary">Real-time Settlements</a></li>
                    <li><a href="#" class="hover:text-primary">Expense Analytics</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h3 class="font-semibold text-foreground mb-4">Support</h3>
                <ul class="space-y-2 text-muted-foreground">
                    <li><a href="#" class="hover:text-primary">Help Center</a></li>
                    <li><a href="#" class="hover:text-primary">Contact Us</a></li>
                    <li><a href="#" class="hover:text-primary">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-primary">Terms of Service</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-border mt-8 pt-8 text-center text-muted-foreground">
            <p>&copy; {{ date('Y') }} Patungann. All rights reserved. Made with ❤️ for smart bill splitting.</p>
        </div>
    </div>
</footer>
@endsection
