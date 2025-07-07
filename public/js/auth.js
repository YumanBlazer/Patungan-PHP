/* ===== PATUNGANN AUTH JAVASCRIPT ===== */

// Form Validation Utilities
class AuthFormValidator {
    constructor() {
        this.initializeValidation();
    }

    initializeValidation() {
        document.addEventListener('DOMContentLoaded', () => {
            this.setupFormValidation();
            this.setupPasswordStrength();
            this.setupSubmitHandling();
        });
    }

    setupFormValidation() {
        const inputs = document.querySelectorAll('.form-input');
        
        inputs.forEach(input => {
            input.addEventListener('blur', () => {
                this.validateField(input);
            });
            
            input.addEventListener('input', () => {
                input.classList.remove('error');
            });
        });
    }

    validateField(input) {
        const value = input.value.trim();
        const isRequired = input.hasAttribute('required');
        
        if (isRequired && value === '') {
            input.classList.add('error');
            return false;
        } else {
            input.classList.remove('error');
            return true;
        }
    }

    setupPasswordStrength() {
        const passwordInput = document.getElementById('password');
        const strengthIndicator = document.getElementById('passwordStrength');
        
        if (passwordInput && strengthIndicator) {
            const strengthBars = strengthIndicator.querySelectorAll('.strength-bar');
            
            passwordInput.addEventListener('input', () => {
                const password = passwordInput.value;
                const strength = this.calculatePasswordStrength(password);
                
                if (password.length > 0) {
                    strengthIndicator.style.display = 'block';
                    this.updateStrengthIndicator(strengthBars, strength);
                } else {
                    strengthIndicator.style.display = 'none';
                }
            });
        }
    }

    calculatePasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        return strength;
    }

    updateStrengthIndicator(strengthBars, strength) {
        strengthBars.forEach((bar, index) => {
            bar.classList.remove('active', 'medium', 'strong');
            if (index < strength) {
                if (strength <= 2) {
                    bar.classList.add('active');
                } else if (strength === 3) {
                    bar.classList.add('medium');
                } else {
                    bar.classList.add('strong');
                }
            }
        });
    }

    setupSubmitHandling() {
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                const submitBtn = form.querySelector('.btn') || form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    
                    // Different loading messages based on form type
                    if (form.action.includes('login')) {
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Signing In...';
                    } else if (form.action.includes('signup') || form.action.includes('register')) {
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Creating Account...';
                    } else {
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Processing...';
                    }
                }
            });
        });
    }
}

// Password Toggle Functionality
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const eyeOpen = document.getElementById('eye-open-' + (fieldId === 'password' ? '1' : '2'));
    const eyeClosed = document.getElementById('eye-closed-' + (fieldId === 'password' ? '1' : '2'));
    
    if (field && eyeOpen && eyeClosed) {
        if (field.type === 'password') {
            field.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        } else {
            field.type = 'password';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        }
    }
}

// Password Match Checker (for registration forms)
function checkPasswordMatch() {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');
    const matchText = document.getElementById('match-text');
    
    if (password && confirmPassword && matchText) {
        if (confirmPassword.value.length === 0) {
            matchText.textContent = '';
            return;
        }
        
        if (password.value === confirmPassword.value) {
            matchText.textContent = '✓ Passwords match';
            matchText.className = 'text-sm text-green-500 mt-1';
        } else {
            matchText.textContent = '✗ Passwords do not match';
            matchText.className = 'text-sm text-red-500 mt-1';
        }
    }
}

// Demo Login Helper
function fillDemoCredentials(email = 'demo@patungann.com', password = 'password123') {
    const emailField = document.getElementById('email');
    const passwordField = document.getElementById('password');
    
    if (emailField) emailField.value = email;
    if (passwordField) passwordField.value = password;
    
    // Remove any error states
    emailField?.classList.remove('error');
    passwordField?.classList.remove('error');
}

// Initialize the validator when script loads
const authValidator = new AuthFormValidator();

// Utility function to show notifications (can be enhanced later)
function showNotification(message, type = 'info') {
    // Simple console log for now, can be enhanced with toast notifications
    console.log(`${type.toUpperCase()}: ${message}`);
}

// Export functions for global use
window.togglePassword = togglePassword;
window.checkPasswordMatch = checkPasswordMatch;
window.fillDemoCredentials = fillDemoCredentials;
window.showNotification = showNotification;
