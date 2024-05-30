document.addEventListener("DOMContentLoaded", function() {
    const inputs = document.querySelectorAll('.form-group input');

    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.style.borderColor = '#4CAF50';
        });
        input.addEventListener('blur', () => {
            input.style.borderColor = '#ddd';
        });
    });
});
