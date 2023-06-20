include('public/js/utils/alert.js');
include('public/js/views/base-user-creator.js');
include('public/js/utils/request.js');

function loadUser() {
    request(window.location.origin + '/users/' + window.location.href.split('/').slice(-1), 'GET').then(user => {
        if (user) {
            document.getElementById('user-editor__title').innerText = user.username;

            document.getElementById('username').value = user.username;
            document.getElementById('username').disabled = true;

            document.getElementById('email').value = user.email;
            document.getElementById('email').disabled = true;
            
            document.getElementById('role').value = user.role;
        }
    });
}

window.addEventListener('load', () => { 
    window.actionButtonName = 'user-editor__action-button';

    loadRoles();
    loadUser();
});

document.getElementById('user-editor__action-button').addEventListener('click', () => {
    document.getElementById('user-editor__action-button').disabled = true;

    const formData = getFormData();
    formData.append('roleId', document.getElementById('role').value);

    request(window.location.origin + '/user', 'POST', formData, {}).then(message => {
        document.getElementById('user-editor__action-button').disabled = false;

        if (message) {
            window.location.replace(
                window.location.origin + "/login"
            );
            return;
        }

        alert('User has not been created.')
    });
});

document.getElementById('role').addEventListener('change', () => changeDisabledStatus());
