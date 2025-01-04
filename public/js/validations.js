document.addEventListener('DOMContentLoaded', function () {

    const loginForm = document.querySelector('.login-form');
    const inputName = document.querySelector('#name')
    const inputEmail = document.querySelector('input[type="email"]');
    const inputPassword = document.querySelector('input[type="password"]');

    const regexName = new RegExp('^[\\w]+$') // Apenas letras e números
    const tegexEmail = new RegExp('^[\\w\\-\\.]+@([\\w\\-]+\\.)+[\\w\\-]{2,4}$'); // Email
    const regexPassword = new RegExp('^[\\w\\W]+$'); // Qualquer caractere

    /**
     * Valida o input de acordo com o regex passado
     * @param {*} input 
     * @param {*} regex 
     * @returns 
     */
    function validateInput(input, regex) {
        console.log(input.value);

        if (!regex.test(input.value)) {

            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
            return false;
        }

        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        return true;
    }

    if (inputEmail) {
        inputEmail.addEventListener('input', function () { validateInput(inputEmail, tegexEmail) });
    }

    if (inputPassword) {
        inputPassword.addEventListener('input', function () { validateInput(inputPassword, regexPassword) });
    }

    if (inputName) {
        inputName.addEventListener('input', function () { validateInput(inputName, regexName) });
    }
});