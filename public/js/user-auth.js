/* NOTE: Comments explain styling/behavior only (no logic change). */
// JavaScript for user authentication forms (login and registration)

document.addEventListener('DOMContentLoaded', () => {
    const signupForm = document.getElementById('signup-form');
    const loginForm = document.getElementById('login-form');

    // allows to clean errors once user edits (to revalidate)
    ['input', 'change'].forEach(evt => {
        signupForm?.addEventListener(evt, e => {
        if (e.target?.setCustomValidity) {
            e.target.setCustomValidity('');
        }
        });

        loginForm?.addEventListener(evt, e => {
        if (e.target?.setCustomValidity) {
            e.target.setCustomValidity('');
        }
        });
    });

    if (signupForm) {
        signupForm.addEventListener('submit', function(e) {
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const phone_number = document.getElementById('phone');
            const confirm = document.getElementById('confirmPassword');

            // clear validity initially
            email.setCustomValidity('');
            phone_number.setCustomValidity('');
            confirm.setCustomValidity('');
            password.setCustomValidity('');

            let hasError = false;
            let passwordError = false;

            if (!email.value.toLowerCase().endsWith('@uwindsor.ca')) {
                email.setCustomValidity('You must register using an @uwindsor.ca email address.');
                hasError = true;
            } 
            
            // regex pattern for valid phone number
            const phoneRegex = /^(\+|00)?[1-9][0-9 \-\(\)\.]{7,32}$/;
            if (phone_number.value.length !== 0 && !phoneRegex.test(phone_number.value)){
                phone_number.setCustomValidity('Please enter a valid phone number (e.g., +1 519 123 4567). Use only numbers, spaces, dashes, or parentheses.');
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
                else if (phone_number.validationMessage) phone_number.reportValidity();
                else if (password.validationMessage) password.reportValidity();
                else if (confirm.validationMessage) confirm.reportValidity();
                
            }
        });
    }

    if(loginForm) {
        //basic client-side validation
        loginForm.addEventListener('submit', function(e) {
            const email_login = document.getElementById('email');
            const password_login = document.getElementById('password');

            email_login.setCustomValidity('');
            password_login.setCustomValidity('');

            let hasError1 = false;
            let passwordError1 = false;

            if (!email_login.value.toLowerCase().endsWith('@uwindsor.ca')) {
                email_login.setCustomValidity('You must sign in using an @uwindsor.ca email address.');
                hasError1 = true;
            } 
            
            if(password_login.value.length < 8) {
                password_login.setCustomValidity('Password must be at least 8 characters long.');
                hasError1 = true;
                passwordError1 = true;
            }

            
            if (hasError1) {
                e.preventDefault(); 
                e.stopPropagation(); 
                
                if (email_login.validationMessage) email_login.reportValidity();
                else if (password_login.validationMessage) password_login.reportValidity();
                
            }
        });

    }

});