// JavaScript for user authentication forms (login and registration)

document.addEventListener('DOMContentLoaded', () => {
    const signupForm = document.getElementById('signup-form');

    if (signupForm) {
        signupForm.addEventListener('submit', function(e) {
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const confirm = document.getElementById('confirmPassword');

            email.setCustomValidity('');
            confirm.setCustomValidity('');

            let hasError = false;

            if (!email.value.toLowerCase().endsWith('@uwindsor.ca')) {
                email.setCustomValidity('You must register using an @uwindsor.ca email address.');
                hasError = true;
            } 
            
            if (password.value !== confirm.value) {
                confirm.setCustomValidity('The password field confirmation does not match.');
                hasError = true;
            }

   
            if (hasError) {
                e.preventDefault(); 
                e.stopPropagation(); 
                
                if (email.validationMessage) email.reportValidity();
                else if (confirm.validationMessage) confirm.reportValidity();
            }
        });

        signupForm.addEventListener('input', (e) => {
            e.target.setCustomValidity('');
        });
    }
});