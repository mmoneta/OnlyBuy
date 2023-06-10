include('public/js/utils/alert.js');
include('public/js/utils/request.js');

const controlNames = ['username', 'password'];

function changeDisabledStatus() {
    document.getElementById('login__action-button').disabled =
        controlNames
            .map(controlName => document.getElementById(controlName).validity.valid)
            .some(valid => !valid);
}

document.getElementById('login__action-button').addEventListener('click', () => {
    document.getElementById('login__action-button').disabled = true;

    request('login', 'POST', JSON.stringify({
        username: document.getElementById('username').value,
        password: document.getElementById('password').value
    })).then(message => {
        if (message) {
            window.location.replace(window.location.origin);
            return;
        }

        alert('Incorrect data');
    });
});

controlNames.forEach(controlName => {
    document.getElementById(controlName).addEventListener('keydown', debounce(() => {
        changeDisabledStatus();
    }, 1000));
});
