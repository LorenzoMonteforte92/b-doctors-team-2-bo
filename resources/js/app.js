import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])


// Validazione password registrazione utente
document.getElementById('registrationForm').addEventListener('submit', function(event){
    event.preventDefault();

    const password = document.querySelector('.password').value;
    const confirmPassword = document.querySelector('.confirm-password').value;

    if (password === confirmPassword){
        this.submit();
    } else {
        const passwordErrors = document.querySelectorAll('.password-error');
        passwordErrors.forEach(function(passwordError){
            passwordError.style.display = 'block';
        })
    }
});

$( document ).ready(function() {
    $('#button').hover(function() {
      $('#call').addClass('animated shake');
    });
  });