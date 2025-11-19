// Toggle password visibility
const togglePassword = document.querySelector('#togglePassword');
const passwordInput = document.querySelector('#pwd');

togglePassword?.addEventListener('click', () => {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    togglePassword.querySelector('i').classList.toggle('ri-eye-off-line');
});
