// JavaScript for user authentication forms (login and registration)

document.addEventListener('DOMContentLoaded', () => {
    const signupForm = document.getElementById('signup-form');
    const loginForm = document.getElementById('login-form');

    if (signupForm) {
        signupForm.addEventListener('submit', function(e) {
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const confirm = document.getElementById('confirmPassword');

            email.setCustomValidity('');
            confirm.setCustomValidity('');
            password.setCustomValidity('');

            let hasError = false;
            let passwordError = false;

            if (!email.value.toLowerCase().endsWith('@uwindsor.ca')) {
                email.setCustomValidity('You must register using an @uwindsor.ca email address.');
                hasError = true;
            } 
            
            if(password.value.length < 8) {
                password.setCustomValidity('Password must be at least 8 characters long.');
                hasError = true;
                passwordError = true;
            }

            //check confirmation if password is valid
            if (!passwordError && password.value !== confirm.value) {
                confirm.setCustomValidity('The password field confirmation does not match.');
                hasError = true;
            }

            
            if (hasError) {
                e.preventDefault(); 
                e.stopPropagation(); 
                
                if (email.validationMessage) email.reportValidity();
                else if (password.validationMessage) password.reportValidity();
                else if (confirm.validationMessage) confirm.reportValidity();
                
            }
        });

        signupForm.addEventListener('input', (e) => {
            e.target.setCustomValidity('');
        });
    }
});