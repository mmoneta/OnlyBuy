include('public/js/utils/alert.js');
include('public/js/views/base-user-creator.js');
include('public/js/utils/request.js');

window.addEventListener('load', () => { 
    window.actionButtonName = 'user-creator__action-button';

    request('roles', 'GET').then(roles => {
        roles.forEach(role => {
            const option = document.createElement('option');

            option.value = role.roleId;
            option.innerHTML = role.name;

            document.getElementById('role').appendChild(option);
        });
    });
});

document.getElementById('user-creator__action-button').addEventListener('click', () => {
    document.getElementById('user-creator__action-button').disabled = true;

    const formData = getFormData();
    formData.append('roleId', document.getElementById('role').value);

    request('user', 'POST', formData, {}).then(message => {
        document.getElementById('user-creator__action-button').disabled = false;

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
