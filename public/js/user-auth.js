//javascript for user login and signup forms
document.addEventListener('DOMContentLoaded', () => {
  const login_form = document.getElementById('login-form');
  if (!login_form) return;

  const signup_form = document.getElementById('signup-form');
  if(!signup_form) return;

//things to validate for signup: password length, uwindsor email, password match, phone number format (optional)
    signup_form.addEventListener('submit', (e) => {
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const emailError = document.getElementById('email-error');
        const matchMessage = document.getElementById('match-message');
    });

//things to validate for login: email and password match (done server side, just need to display error message)
    login_form.addEventListener('submit', (e) => {
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');
    });

});