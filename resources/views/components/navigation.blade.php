<nav class="bg-card border-b border-border sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center gap-4">
                <a href="{{ route('welcome') }}" class="flex items-center gap-2">
                    <img src="{{ asset('logo.png') }}" alt="Patungann" class="h-8 w-8">
                    <span class="font-bold text-xl text-primary">Patungann</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-6">
                @auth
                    <a href="{{ route('dashboard') }}" 
                       class="text-foreground hover:text-primary transition-colors
                              {{ request()->routeIs('dashboard') ? 'text-primary font-medium' : '' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('bills.index') }}" 
                       class="text-foreground hover:text-primary transition-colors
                              {{ request()->routeIs('bills.*') ? 'text-primary font-medium' : '' }}">
                        Bills
                    </a>

                    <a href="{{ route('app.index') }}" 
                       class="text-foreground hover:text-primary transition-colors
                              {{ request()->routeIs('app.*') ? 'text-primary font-medium' : '' }}">
                        App
                    </a>

                    @if(session('user.is_admin', false))
                        <a href="{{ route('admin.index') }}" 
                           class="text-foreground hover:text-primary transition-colors
                                  {{ request()->routeIs('admin.*') ? 'text-primary font-medium' : '' }}">
                            Admin
                        </a>
                    @endif

                    <!-- User Menu -->
                    <div class="relative group">
                        <button class="flex items-center gap-2 text-foreground hover:text-primary transition-colors">
                            @if(session('user.avatar_url'))
                                <img src="{{ session('user.avatar_url') }}" 
                                     alt="{{ session('user.name', 'Demo User') }}" 
                                     class="h-8 w-8 rounded-full">
                            @else
                                <div class="h-8 w-8 rounded-full bg-primary flex items-center justify-center text-primary-foreground text-sm font-medium">
                                    {{ substr(session('user.name', 'Demo User'), 0, 1) }}
                                </div>
                            @endif
                            <span class="hidden lg:block">{{ session('user.name', 'Demo User') }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-card border border-border rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <div class="py-2">
                                <a href="{{ route('app.profile') }}" 
                                   class="block px-4 py-2 text-sm text-foreground hover:bg-muted transition-colors">
                                    Profile
                                </a>
                                <a href="{{ route('app.history') }}" 
                                   class="block px-4 py-2 text-sm text-foreground hover:bg-muted transition-colors">
                                    History
                                </a>
                                <div class="border-t border-border my-1"></div>
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full text-left px-4 py-2 text-sm text-destructive hover:bg-muted transition-colors">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        Sign Up
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-foreground hover:text-primary">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-border mt-2 pt-2 pb-4">
            @auth
                <a href="{{ route('dashboard') }}" class="block py-2 text-foreground hover:text-primary">Dashboard</a>
                <a href="{{ route('bills.index') }}" class="block py-2 text-foreground hover:text-primary">Bills</a>
                <a href="{{ route('app.index') }}" class="block py-2 text-foreground hover:text-primary">App</a>
                @if(session('user.is_admin', false))
                    <a href="{{ route('admin.index') }}" class="block py-2 text-foreground hover:text-primary">Admin</a>
                @endif
                <a href="{{ route('app.profile') }}" class="block py-2 text-foreground hover:text-primary">Profile</a>
                <div class="border-t border-border my-2"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block py-2 text-destructive hover:text-destructive/80">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block py-2 text-foreground hover:text-primary">Login</a>
                <a href="{{ route('register') }}" class="block py-2 text-foreground hover:text-primary">Sign Up</a>
            @endauth
        </div>
    </div>
</nav>

<script>
// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
});
</script>