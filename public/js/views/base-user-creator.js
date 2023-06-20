include('public/js/utils/files.js');

const controlNames = ['username', 'email', 'password', 'repeat-password'];

function changeDisabledStatus() {
    document.getElementById(window.actionButtonName).disabled =
        controlNames
            .map(controlName => document.getElementById(controlName).validity.valid)
            .some(valid => !valid)
        || document.getElementById('password').value !== document.getElementById('repeat-password').value;
}

function getFormData() {
    const formData = new FormData();

    formData.append('avatar', document.getElementById('avatar').files[0]);
    formData.append('username', document.getElementById('username').value);
    formData.append('email', document.getElementById('email').value);
    formData.append('password', document.getElementById('password').value);

    return formData;
}

function loadRoles() {
    request(window.location.origin + '/roles', 'GET').then(roles => {
        roles.forEach(role => {
            const option = document.createElement('option');

            option.value = role.roleId;
            option.innerHTML = role.name;

            document.getElementById('role').appendChild(option);
        });
    });
}

document.getElementById('avatar').addEventListener('change', () => handleUpload('avatar'));

handleControlsEvent(controlNames, 'keydown', debounce(() => changeDisabledStatus(), 1000));
