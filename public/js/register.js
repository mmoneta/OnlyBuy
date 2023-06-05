include('public/js/post-data.js');

const controlNames = ['username', 'email', 'password', 'repeat-password'];

function changeDisabledStatus() {
    document.getElementById('register__action-button').disabled =
        controlNames
            .map(controlName => document.getElementById(controlName).validity.valid)
            .some(valid => !valid)
        || document.getElementById('password').value !== document.getElementById('repeat-password').value;
}

document.getElementById('register__action-button').addEventListener('click', () => {
    document.getElementById('register__action-button').disabled = true;

    postData('register', {
        username: document.getElementById('username').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value,
    }).then(message => {
        document.getElementById('register__action-button').disabled = false;

        if (message) {
            window.location.replace(
                window.location.origin + "/login"
            );
        }
    });
});

controlNames.forEach(controlName => {
    document.getElementById(controlName).addEventListener('keydown', debounce(() => {
        changeDisabledStatus();
    }, 1000));
});
