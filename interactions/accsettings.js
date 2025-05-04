document.addEventListener('DOMContentLoaded', function() {
    // Tab navigation
    const tabs = {
        'accountTab': 'accountSection',
        'securityTab': 'securitySection',
        'privacyTab': 'privacySection',
        'billingTab': 'billingSection',
        'notificationsTab': 'notificationsSection'
    };
    
    Object.keys(tabs).forEach(tabId => {
        document.getElementById(tabId)?.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Hide all sections
            Object.values(tabs).forEach(sectionId => {
                document.getElementById(sectionId).style.display = 'none';
            });
            
            // Show selected section
            document.getElementById(tabs[tabId]).style.display = 'block';
            
            // Update active tab
            document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Password toggle visibility
    document.querySelectorAll('.toggle-password').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            
            if (input.type === 'password') {
                input.type = 'text';
                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                input.type = 'password';
                this.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
    });
    
    // Show/Hide password change form
    const showChangePasswordBtn = document.getElementById('showChangePassword');
    const changePasswordSection = document.getElementById('changePasswordSection');
    const cancelPasswordChangeBtn = document.getElementById('cancelPasswordChange');
    
    if (showChangePasswordBtn && changePasswordSection) {
        showChangePasswordBtn.addEventListener('click', function() {
            changePasswordSection.style.display = 'block';
            this.style.display = 'none';
        });
    }
    
    if (cancelPasswordChangeBtn && changePasswordSection && showChangePasswordBtn) {
        cancelPasswordChangeBtn.addEventListener('click', function() {
            changePasswordSection.style.display = 'none';
            showChangePasswordBtn.style.display = 'inline-block';
            document.getElementById('changePasswordForm').reset();
        });
    }
    
    // Password strength meter
    const newPasswordInput = document.getElementById('newPassword');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const passwordStrength = document.getElementById('passwordStrength');
    const passwordFeedback = document.getElementById('passwordFeedback');
    const passwordMatch = document.getElementById('passwordMatch');
    
    if (newPasswordInput && passwordStrength && passwordFeedback) {
        newPasswordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let feedback = '';
            
            // Check length
            if (password.length >= 8) {
                strength += 25;
            }
            
            // Check for lowercase letters
            if (password.match(/[a-z]/)) {
                strength += 25;
            }
            
            // Check for uppercase letters
            if (password.match(/[A-Z]/)) {
                strength += 25;
            }
            
            // Check for numbers or special characters
            if (password.match(/[0-9]/) || password.match(/[^a-zA-Z0-9]/)) {
                strength += 25;
            }
            
            // Update strength meter
            passwordStrength.style.width = strength + '%';
            
            // Set color based on strength
            if (strength <= 25) {
                passwordStrength.style.backgroundColor = '#e74a3b';
                feedback = 'Weak password';
            } else if (strength <= 50) {
                passwordStrength.style.backgroundColor = '#f6c23e';
                feedback = 'Fair password';
            } else if (strength <= 75) {
                passwordStrength.style.backgroundColor = '#4e73df';
                feedback = 'Good password';
            } else {
                passwordStrength.style.backgroundColor = '#1cc88a';
                feedback = 'Strong password';
            }
            
            passwordFeedback.textContent = feedback;
            
            // Check password match if confirm password has input
            if (confirmPasswordInput.value) {
                checkPasswordMatch();
            }
        });
    }
    
    // Check if passwords match
    function checkPasswordMatch() {
        if (newPasswordInput.value === confirmPasswordInput.value) {
            passwordMatch.textContent = 'Passwords match';
            passwordMatch.className = 'password-feedback text-success';
        } else {
            passwordMatch.textContent = 'Passwords do not match';
            passwordMatch.className = 'password-feedback text-danger';
        }
    }
    
    if (confirmPasswordInput && passwordMatch) {
        confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    }
    
    // Form validation
    const changePasswordForm = document.getElementById('changePasswordForm');
    if (changePasswordForm) {
        changePasswordForm.addEventListener('submit', function(e) {
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match. Please try again.');
                return false;
            }
            
            // Here you would normally do additional validation
            // This is where AJAX could be used to submit the form without reloading
            
            // For demo purposes, we'll just prevent the default form submission
            e.preventDefault();
            
            // Simulate successful password change
            alert('Password changed successfully!');
            
            // Reset form and hide
            this.reset();
            changePasswordSection.style.display = 'none';
            showChangePasswordBtn.style.display = 'inline-block';
            
            // Update last password change time
            document.getElementById('lastPasswordChange').textContent = new Date().toLocaleString();
        });
    }
    
    // Initialize profile form
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simulate saving profile info
            alert('Profile information updated successfully!');
            
            // In a real application, you would use AJAX to submit the form
            // and handle the response accordingly
        });
    }
});