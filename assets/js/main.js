$(function () {
    $('form').on('submit', function (event) {
        let isValid = true;

        $('.field-error').remove();
        $('input').removeClass('input-error');

        const email = $('#email');
        const password = $('#password');
        const passwordConfirm = $('#password_confirm');

        if (email.length && !isValidEmail(email.val())) {
            showError(email, 'Kérlek, adj meg egy érvényes e-mail címet.');
            isValid = false;
        }

        if (password.length && password.val().length < 6) {
            showError(password, 'A jelszónak legalább 6 karakter hosszúnak kell lennie.');
            isValid = false;
        }

        if (
            passwordConfirm.length &&
            password.val() !== passwordConfirm.val()
        ) {
            showError(passwordConfirm, 'A két jelszó nem egyezik.');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    function showError(input, message) {
        input.addClass('input-error');
        input.after('<p class="field-error">' + message + '</p>');
    }

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
});