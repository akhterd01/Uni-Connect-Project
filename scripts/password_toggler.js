const passwordEye = document.querySelector('.password-eye');
const passwordEyeConfirm = document.querySelector('.password-eye-confirm');

passwordEye.addEventListener('mousedown', (e) => {

    const passwordInput = document.querySelector('#password');

    e.currentTarget.classList.remove('fa-eye-slash');
    e.currentTarget.classList.add('fa-eye');
    passwordInput.setAttribute('type', 'text');

});

passwordEye.addEventListener('mouseup', (e) => {

    const passwordInput = document.querySelector('#password');

    e.currentTarget.classList.remove('fa-eye');
    e.currentTarget.classList.add('fa-eye-slash');
    passwordInput.setAttribute('type', 'password');

});

passwordEye.addEventListener('mouseout', (e) => {

    const passwordInput = document.querySelector('#password');

    e.currentTarget.classList.remove('fa-eye');
    e.currentTarget.classList.add('fa-eye-slash');
    passwordInput.setAttribute('type', 'password');

});

passwordEyeConfirm.addEventListener('mousedown', (e) => {

    const passwordInputConfirm = document.querySelector('#passwordconfirm');

    e.currentTarget.classList.remove('fa-eye-slash');
    e.currentTarget.classList.add('fa-eye');
    passwordInputConfirm.setAttribute('type', 'text');

});

passwordEyeConfirm.addEventListener('mouseup', (e) => {

    const passwordInputConfirm = document.querySelector('#passwordconfirm');

    e.currentTarget.classList.remove('fa-eye');
    e.currentTarget.classList.add('fa-eye-slash');
    passwordInputConfirm.setAttribute('type', 'password');

});

passwordEyeConfirm.addEventListener('mouseout', (e) => {

    const passwordInputConfirm = document.querySelector('#passwordconfirm');

    e.currentTarget.classList.remove('fa-eye');
    e.currentTarget.classList.add('fa-eye-slash');
    passwordInputConfirm.setAttribute('type', 'password');

});