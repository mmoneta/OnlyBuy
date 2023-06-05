include('public/js/post-data.js');

const controlNames = ['username', 'password'];

function changeDisabledStatus() {
    document.getElementById('login__action-button').disabled =
        controlNames
            .map(controlName => document.getElementById(controlName).validity.valid)
            .some(valid => !valid);
}

document.getElementById('login__action-button').addEventListener('click', () => {
    document.getElementById('login__action-button').disabled = true;

    postData('login', {
        username: document.getElementById('username').value,
        password: document.getElementById('password').value
    }).then(message => {
        document.getElementById('login__action-button').disabled = false;
        console.log(message);

        if (message) {
            
        }
    });
});

controlNames.forEach(controlName => {
    document.getElementById(controlName).addEventListener('keydown', debounce(() => {
        changeDisabledStatus();
    }, 1000));
});
