<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Patungann</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
</head>
<body>
    <div class="bg-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <a href="{{ route('welcome') }}" class="back-home">
        <i class="fas fa-arrow-left"></i>
        Back to Home
    </a>
    
    <div class="container">
        <div class="register-card">
            <div class="logo-section">
                <div class="logo">
                    <div class="logo-icon">💰</div>
                    Patungann
                </div>
                <h1 class="welcome-text">Join Patungann</h1>
                <p class="subtitle">Create your account and start splitting bills smarter</p>
            </div>
            
            <form method="POST" action="{{ url('/signup') }}">
                @csrf
                
                <div class="form-row">
                    <div class="form-group half">
                        <label for="full_name" class="form-label">Full Name <span class="required">*</span></label>
                        <input 
                            type="text" 
                            id="full_name" 
                            name="full_name" 
                            class="form-input @error('full_name') error @enderror"
                            placeholder="Your full name"
                            value="{{ old('full_name') }}"
                            required
                        >
                        @error('full_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group half">
                        <label for="username" class="form-label">Username <span class="required">*</span></label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            class="form-input @error('username') error @enderror"
                            placeholder="Choose username"
                            value="{{ old('username') }}"
                            required
                        >
                        @error('username')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email Address <span class="required">*</span></label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input @error('email') error @enderror"
                        placeholder="Enter your email"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        class="form-input @error('phone') error @enderror"
                        placeholder="Your phone number (optional)"
                        value="{{ old('phone') }}"
                    >
                    @error('phone')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password <span class="required">*</span></label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input @error('password') error @enderror"
                        placeholder="Create a strong password"
                        required
                    >
                    <div class="password-strength" id="passwordStrength" style="display: none;">
                        <div>Password strength:</div>
                        <div class="strength-indicator">
                            <div class="strength-bar"></div>
                            <div class="strength-bar"></div>
                            <div class="strength-bar"></div>
                            <div class="strength-bar"></div>
                        </div>
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password <span class="required">*</span></label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="form-input"
                        placeholder="Confirm your password"
                        required
                    >
                </div>
                
                <label class="terms-checkbox">
                    <input type="checkbox" name="terms" required>
                    <span>
                        I agree to the <a href="#" target="_blank">Terms of Service</a> and 
                        <a href="#" target="_blank">Privacy Policy</a>
                    </span>
                </label>
                
                <button type="submit" class="btn">
                    <i class="fas fa-user-plus"></i>&nbsp;&nbsp;Create Account
                </button>
            </form>
            
            <div class="divider">
                <span>or</span>
            </div>
            
            <div class="login-link">
                Already have an account? <a href="{{ route('login') }}">Sign in here</a>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>